<?php

namespace App\Repositories\Backend;

use App\Events\Backend\Blogs\BlogCreated;
use App\Events\Backend\Blogs\BlogDeleted;
use App\Events\Backend\Blogs\BlogUpdated;
use App\Exceptions\GeneralException;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogMapCategory;
use App\Models\BlogMapTag;
use App\Models\BlogTag;
use App\TestQuestion;
use App\Repositories\BaseRepository;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Excel;
use App\Imports\TestQuestionImport;

class BlogsRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Blog::class;

    protected $upload_path;

    /**
     * Sortable.
     *
     * @var array
     */
    private $sortable = [
        'id',
        'name',
        'slug',
        'publish_datetime',
        'content',
        'meta_title',
        'status',
        'created_at',
        'updated_at',
    ];

    /**
     * Storage Class Object.
     *
     * @var \Illuminate\Support\Facades\Storage
     */
    protected $storage;

    public function __construct()
    {
        $this->upload_path = 'img'.DIRECTORY_SEPARATOR.'blog'.DIRECTORY_SEPARATOR;
        $this->storage = Storage::disk('public');
    }

    /**
     * Retrieve List.
     *
     * @var array
     * @return Collection
     */
    public function retrieveList(array $options = [])
    {
        $perPage = isset($options['per_page']) ? (int) $options['per_page'] : 20;
        $orderBy = isset($options['order_by']) && in_array($options['order_by'], $this->sortable) ? $options['order_by'] : 'created_at';
        $order = isset($options['order']) && in_array($options['order'], ['asc', 'desc']) ? $options['order'] : 'desc';
        $query = $this->query()
            ->with([
                'owner',
                'updater',
            ])
            ->orderBy($orderBy, $order);

        if ($perPage == -1) {
            return $query->get();
        }

        return $query->paginate($perPage);
    }

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->leftjoin('users', 'users.id', '=', 'blogs.created_by')
            ->select([
                'blogs.id',
                'blogs.name',
                'blogs.publish_datetime',
                'blogs.status',
                'blogs.created_by',
                'blogs.created_at',
                'users.first_name as user_name',
            ]);
    }

    /**
     * @param array $input
     *
     * @throws \App\Exceptions\GeneralException
     *
     * @return bool
     */
    public function create(array $input)
    {

        $tagsArray = $this->createTags($input['tags']);
        $categoriesArray = $this->createCategories($input['categories']);

        unset($input['tags'], $input['categories']);

        return DB::transaction(function () use ($input, $tagsArray, $categoriesArray) {
            $input['slug'] = Str::slug($input['name']);
            $input['publish_datetime'] = Carbon::parse($input['publish_datetime']);
            $input['created_by'] = auth()->user()->id;

            $input = $this->uploadImage($input);

            if ($blog = Blog::create($input)) {
                // Inserting associated category's id in mapper table
                if (count($categoriesArray)) {
                    $blog->categories()->sync($categoriesArray);
                }

                // Inserting associated tag's id in mapper table
                if (count($tagsArray)) {
                    $blog->tags()->sync($tagsArray);
                }

                // Updating Id in Test Question
                \DB::update('update test_question set test_id = ? where test_code = ?', array($blog->id, $input['meta_title']));
                event(new BlogCreated($blog));

                return $blog;
            }

            throw new GeneralException(__('exceptions.backend.blogs.create_error'));
        });
    }

    /**
     * @param \App\Models\Blog $blog
     * @param array $input
     */
    public function update(Blog $blog, array $input)
    {
        $tagsArray = $this->createTags($input['tags']);
        $categoriesArray = $this->createCategories($input['categories']);

        unset($input['tags'], $input['categories']);

        $input['slug'] = Str::slug($input['name']);
        $input['updated_by'] = auth()->user()->id;
        $input['publish_datetime'] = Carbon::parse($input['publish_datetime']);
        // Uploading Image
        if (array_key_exists('featured_image', $input)) {
            $this->deleteOldFile($blog);
            $input = $this->uploadImage($input);
        }

        return DB::transaction(function () use ($blog, $input, $tagsArray, $categoriesArray) {
            if ($blog->update($input)) {
                // Updateing associated category's id in mapper table
                if (count($categoriesArray)) {
                    $blog->categories()->sync($categoriesArray);
                }

                // Updating associated tag's id in mapper table
                if (count($tagsArray)) {
                    $blog->tags()->sync($tagsArray);
                }
                
                // Updating Id in Test Question
                \DB::update('update test_question set test_id = ? where test_code = ?', array($blog->id, $input['meta_title']));

                event(new BlogUpdated($blog));

                return $blog->fresh();
            }

            throw new GeneralException(__('exceptions.backend.blogs.update_error'));
        });
    }

    /**
     * Creating Tags.
     *
     * @param array $tags
     *
     * @return array
     */
    public function createTags($tags)
    {
        //Creating a new array for tags (newly created)
        $tags_array = [];

        foreach ($tags as $tag) {
            if (is_numeric($tag)) {
                $tags_array[] = $tag;
            } else {
                $newTag = BlogTag::firstOrCreate(
                    [
                        'name' => $tag,
                    ],
                    [
                        'name' => $tag,
                        'status' => 1,
                        'created_by' => auth()->user()->id,
                    ]
                );
                $tags_array[] = $newTag->id;
            }
        }

        return $tags_array;
    }

    /**
     * Creating Categories.
     *
     * @param array $categories
     *
     * @return array
     */
    public function createCategories($categories)
    {
        //Creating a new array for categories (newly created)
        $categories_array = [];

        foreach ($categories as $category) {
            if (is_numeric($category)) {
                $categories_array[] = $category;
            } else {
                $newCategory = BlogCategory::firstOrCreate(
                    [
                        'name' => $category,
                    ],
                    [
                        'name' => $category,
                        'status' => 1,
                        'created_by' => auth()->user()->id,
                    ]
                );

                $categories_array[] = $newCategory->id;
            }
        }

        return $categories_array;
    }

    /**
     * @param \App\Models\Blogs\Blog $blog
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete(Blog $blog)
    {
        DB::transaction(function () use ($blog) {
            if ($blog->delete()) {
                BlogMapCategory::where('blog_id', $blog->id)->delete();
                BlogMapTag::where('blog_id', $blog->id)->delete();

                event(new BlogDeleted($blog));

                return true;
            }

            throw new GeneralException(__('exceptions.backend.blogs.delete_error'));
        });
    }

    /**
     * Upload Image.
     *
     * @param array $input
     *
     * @return array $input
     */
    public function uploadImage($input)
    {
        if (isset($input['featured_image']) && ! empty($input['featured_image'])) {
            $file = $input['featured_image'];
            //$path = $file->getRealPath();
            if($input['status'] == 2) { 
                //$path = $file->store('temp'); 
                //$path1  = storage_path('app').'/'.$path;
                //Excel::import(new TestQuestionImport, $path1);
                require '../laravel/vendor_phpoffice/autoload.php';
                $path1 = $file->getPathName();
                $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($path1);

                $ws = $spreadsheet->getActiveSheet();
                $wsExt = new WorksheetDrawingExt($ws);
                $i = $j = 0;
                $time = time();
                $keyArr = array(
                    "A" => 'serial_no',
                    "B" => 'test_code',
                    "C" => 'question',
                    "D" => 'option_1',
                    "E" => 'option_2',
                    "F" => 'option_3',
                    "G" => 'option_4',
                    "H" => 'answer',
                    "I" => 'solution' 
                );
                $dataObject = array();
                foreach ($ws->getRowIterator() as $row) {
                    $dataObject[$j] = array();      
                    $cellIterator = $row->getCellIterator();
                    $cellIterator->setIterateOnlyExistingCells(FALSE); 
                    foreach ($cellIterator as $cell) {
                        $coord = $cell->getCoordinate();
                        $contentValue = $cell->getValue();
                        $dataObject[$j][$keyArr[$coord[0]]] = $contentValue;
                        $ds = $wsExt->drawingsForCoordinate($coord);
                        foreach($ds as $d) {
                            $zipReader = fopen($d->getPath(), 'r');  
                            $imageContents = '';
                            while (!feof($zipReader)) {
                                $imageContents .= fread($zipReader, 1024);
                            }
                            fclose($zipReader); 
                            $tempFilePath = $time . "_" . $i .'.'.'png';
                            Storage::disk('public')->put("question_images/" . $tempFilePath, $imageContents);
                            $dataObject[$j][$keyArr[$coord[0]]] .= '<img src="' . asset('storage/question_images/' . $tempFilePath) . '"/>';
                            $i++;
                        }
                    }
                    $j++;
                }
                $path = "XLS Uploaded";
                unset($dataObject[0]);
                TestQuestion::insert($dataObject);
            } else {
                $path = $file->storeAs('question_paper', $file->getClientOriginalName(), 'public');
            }
            $input['featured_image'] = $path;
        }
        return $input;
    }

    /**
     * Destroy Old Image.
     *
     * @param int $id
     */
    public function deleteOldFile($model)
    {
        return \DB::delete('delete from test_question where test_id = ?', array($model->id));
    }
}

class WorksheetDrawingExt {
    private $idx = array();

    /**
     * Upon construction will build an index drawings and their locations
     */
    public function __construct($ws) {
        $this->createDrawingIndex($ws);
    }

    private function addDrawingToCell($coord,$drawing) {
        if (array_key_exists($coord,$this->idx)) {
            //There's already one image here - append a new
            $this->idx[$coord][]=$drawing;
        } else {
            //No images so far, setup the base array
            $this->idx[$coord]=[$drawing];
        }
    }

    private function createDrawingIndex($ws) {
        $drawings=$ws->getDrawingCollection();
        foreach ($drawings as $drawing) {
            $coord=$drawing->getCoordinates();//Inconsistent plural!
            $this->addDrawingToCell($coord,$drawing);
        }
    }

    /**
     * Get all drawings for a cell (always returns an array even if there's 1 or less images)
     */
    public function drawingsForCell($cell):array {
        return $this->drawingsForCoordinate($cell->getCoordinate());
    }

    /**
     * Get all drawings at the given coordinate (always returns an array even if there's 1 or less images)
     */
    public function drawingsForCoordinate(string $coordinate):array {
        if (array_key_exists($coordinate,$this->idx)) {
            return $this->idx[$coordinate];
        } else {
            return [];
        }
    }
}