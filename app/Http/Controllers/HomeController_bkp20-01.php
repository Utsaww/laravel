<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Models\Blog;
use App\Models\BlogCategory;
use Session;

class HomeController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index($coursename = '')
    {
        $coursename = getPrettyUrl($coursename);
        $coursesDB = \DB::select("select id,name from blog_tags where status = 1 and deleted_at is null order by id limit 3");
        $courseId = "";
        $courseIdStr = "";
        $courses = array();
        foreach($coursesDB as $course) {
            $courses[$course->id] = $course->name;
            $courseIdStr .= ($courseIdStr == "")?$course->id:",".$course->id;
            if($course->name == $coursename) {
                $courseName = $coursename;
                $courseId = $course->id;
            }
            if($coursename == "" && $courseId == "") {
                $courseName = $course->name;
                $courseId = $course->id;
            }
        }
        if(empty($courseId)) {
            echo empty($courseName)?"Server Down":"Url Does Not Exists";exit;
        }
        $testData = \DB::select('select B.name as test_name, B.id as test_id, BTM.tag_id as course_id, B.content, B.status, B.featured_image from blogs B left join blog_map_tags BTM on B.id = BTM.blog_id left join blog_map_categories BMC on B.id = BMC.blog_id where B.status IN (1,2,3,4,5) and B.deleted_at is null and BTM.tag_id in(' . $courseIdStr .') order by B.id desc');
        $testList = array();
        $statusesArr = Blog::$statusesArr;
        foreach($testData as $test) {
            if(!isset($testList[$test->course_id][$test->status])) {
                $testList[$test->course_id][$test->status] = array("name" => $statusesArr[$test->status], "id" => $test->status);
            }
        }
        return view('users.index', compact('testList', 'courses', 'courseName', 'courseId'));
    }

    public function allCourseTest($coursename = '')
    {
        $courseName = getPrettyUrl($coursename);
        if(!empty($courseName)) {
            $whereStr = " and name = '" . getPrettyUrl($courseName) . "'";
        }
        $courseData = \DB::select("select id,name from blog_tags where status = 1 and deleted_at is null $whereStr order by id limit 1");
        if(empty($courseData) || empty($courseData[0])) {
            echo empty($courseName)?"Server Down":"Url Does Not Exists";exit;
        }
        $courseId   = $courseData[0]->id;
        
        $statusesArr = Blog::$statusesArr;
        $testData = \DB::select('select B.course_content, B.status, B.name as test_name, B.id as test_id, B.content, B.status, B.featured_image, BMC.category_id, C.name as class_name from blogs B left join blog_map_tags BTM on B.id = BTM.blog_id left join blog_map_categories BMC ON BMC.blog_id = B.id left join blog_categories C on C.id = BMC.category_id where BTM.tag_id = ' . $courseId . ' and B.status IN (1,2,3,4,5) and B.deleted_at is null');
        
        $testList = array();
        $detailContent = '';
        $moduleName = $courseName;
        $urlString = '<div class="bratekram"><ul><li><a href="javascript:void(0)" class="active" >' . $courseName . '</a></li></ul></div>';
        foreach($testData as $test) {
            $detailContent = $test->course_content;
            if(!isset($testList[$test->status])) {
                $testList[$test->status] = $statusesArr[$test->status];
            }
        }
        return view('users.coursealltest', compact('testList', 'detailContent', 'moduleName', 'urlString'));
    }

    public function courseTypeAllTest($coursename = '', $type = '')
    {

        $whereStr = "";
        if(!empty($coursename)) {
            $whereStr = " and name = '" . getPrettyUrl($coursename) . "'";
        }
        $courseData = \DB::select("select id,name from blog_tags where status = 1 and deleted_at is null $whereStr order by id limit 1");
        if(empty($courseData) || empty($courseData[0])) {
            echo empty($coursename)?"Server Down":"Url Does Not Exists";exit;
        }

        $courseId   = $courseData[0]->id;
        $courseName = $courseData[0]->name;
        $statusesArr = Blog::$statusesArr;
        $typeName = $statusesArr[$type];

        $detailContent = '';
        $moduleName = $typeName;
        $urlString = '<div class="bratekram"><ul><li><a href="/">' . $courseName . '</a></li><li><a>&gt;</a></li><li><a href="javascript:void(0)" class="active" >' . $typeName . '</a></li></ul></div>';
        $allCourse = BlogCategory::getSelectData();
        $tempIndexArr = array();
        $testList = array();
        $testData = \DB::select('select B.status_content, B.status, B.name as test_name, B.id as test_id, B.content, B.featured_image, BMC.category_id from blogs B left join blog_map_tags BTM on B.id = BTM.blog_id left join blog_map_categories BMC ON BMC.blog_id = B.id where BTM.tag_id = ' . $courseId . ' and B.status = ' . $type . ' and B.deleted_at is null order by B.id desc');
        foreach($testData as $test) {
            $detailContent = $test->status_content;
            if(!empty($test->category_id) && !in_array($test->category_id, $tempIndexArr)) {
                $tempIndexArr[] = $test->category_id;
                $testList[] = (object) array("is_submodule" => true, "name" => $allCourse[$test->category_id]);
            } else if(empty($test->category_id)){
                $testList[] = $test;
            }
        }
        return view('users.coursetypealltest', compact('testList', 'courseName', 'type', 'detailContent', 'urlString', 'moduleName'));
    }

    public function courseTypeCategotyAllTest($coursename = '', $type = '', $categoryname = '')
    {

        $whereStr = "";
        if(!empty($coursename)) {
            $whereStr = " and name = '" . getPrettyUrl($coursename) . "'";
        }
        $courseData = \DB::select("select id,name from blog_tags where status = 1 and deleted_at is null $whereStr order by id limit 1");
        if(empty($courseData) || empty($courseData[0])) {
            echo empty($coursename)?"Server Down":"Url Does Not Exists";exit;
        }

        if(!empty($categoryname)) {
            $whereStr = " and name = '" . getPrettyUrl($categoryname) . "'";
        }
        $classData = \DB::select("select id,name from blog_categories where status = 1 and deleted_at is null $whereStr order by id limit 1");
        if(empty($classData) || empty($classData[0])) {
            echo empty($classname)?"Server Down":"Url Does Not Exists";exit;
        }

        $courseId   = $courseData[0]->id;
        $courseName = $courseData[0]->name;

        $classId   = $classData[0]->id;
        $className = $classData[0]->name;

        $statusesArr = Blog::$statusesArr;
        $typeName = $statusesArr[$type];
        $allCourse = BlogCategory::getSelectData();

        $testList = array();        
        $testData = \DB::select('select B.class_content, B.status, B.name as test_name, B.id as test_id, B.content, B.status, B.featured_image, B.subject_id from blogs B left join blog_map_tags BTM on B.id = BTM.blog_id left join blog_map_categories BMC ON BMC.blog_id = B.id where BTM.tag_id = ' . $courseId . ' and BMC.category_id = ' . $classId . ' and B.status = ' . $type . ' and B.deleted_at is null order by B.id desc');
        
        $detailContent = '';
        $moduleName = $className;
        $urlString = '<div class="bratekram"><ul><li><a href="/">' . $courseName . '</a></li><li><a>&gt;</a></li><li><a href="' . url(setPrettyUrl($courseName). '/' . $type . '/list') . '">' . $typeName . '</a></li><li><a>&gt;</a></li><li><a href="javascript:void(0)" class="active" >' . $className . '</a></li></ul></div>';
        $tempIndexArr = array();
        foreach($testData as $test) {
            $detailContent = $test->class_content;
            if(!empty($test->subject_id) && !in_array($test->subject_id, $tempIndexArr)) {
                $tempIndexArr[] = $test->subject_id;
                $testList[] = (object) array("is_submodule" => true, "name" => $allCourse[$test->subject_id]);
            } else if(empty($test->subject_id)){
                $testList[] = $test;
            }
        }
        return view('users.coursetypeclassalltest', compact('testList', 'courseName', 'type', 'className', 'detailContent', 'urlString', 'moduleName'));
    }

    public function courseTypeCategotySubjectAllTest($coursename = '', $type = '', $categoryname = '', $subjectname = '', $topicname = '')
    {

        $whereStr = "";
        if(!empty($coursename)) {
            $whereStr = " and name = '" . getPrettyUrl($coursename) . "'";
        }
        $courseData = \DB::select("select id,name from blog_tags where status = 1 and deleted_at is null $whereStr order by id limit 1");
        if(empty($courseData) || empty($courseData[0])) {
            echo empty($coursename)?"Server Down":"Url Does Not Exists";exit;
        }
        if(!empty($categoryname)) {
            $whereStr = " and name = '" . getPrettyUrl($categoryname) . "'";
        }
        $classData = \DB::select("select id,name from blog_categories where status = 1 and type = 1 and deleted_at is null $whereStr order by id limit 1");
        if(empty($classData) || empty($classData[0])) {
            echo empty($categoryname)?"Server Down":"Url Does Not Exists";exit;
        }

        if(!empty($subjectname)) {
            $whereStr = " and name = '" . getPrettyUrl($subjectname) . "'";
        }
        $subjectData = \DB::select("select id,name from blog_categories where status = 1 and type = 2 and deleted_at is null $whereStr order by id limit 1");
        if(empty($subjectData) || empty($subjectData[0])) {
            echo empty($subjectname)?"Server Down":"Url Does Not Exists";exit;
        }

        $courseId   = $courseData[0]->id;
        $courseName = $courseData[0]->name;

        $classId   = $classData[0]->id;
        $className = $classData[0]->name;

        $subjectId   = $subjectData[0]->id;
        $subjectName = $subjectData[0]->name;

        $statusesArr = Blog::$statusesArr;
        $typeName = $statusesArr[$type];
        $allCourse = BlogCategory::getSelectData();

        $testList = array();
        $testData = \DB::select('select B.subject_content, B.status, B.name as test_name, B.id as test_id, B.content, B.status, B.featured_image, B.topic_id from blogs B left join blog_map_tags BTM on B.id = BTM.blog_id left join blog_map_categories BMC ON BMC.blog_id = B.id where BTM.tag_id = ' . $courseId . ' and BMC.category_id = ' . $classId . ' and B.status = ' . $type . ' and B.subject_id = ' . $subjectId  . ' and B.deleted_at is null order by B.id desc');
        
        $detailContent = '';
        $moduleName = $subjectName;
        $urlString = '<div class="bratekram"><ul><li><a href="/">' . $courseName . '</a></li><li><a>&gt;</a></li><li><a href="' . url(setPrettyUrl($courseName). '/' . $type . '/list') . '">' . $typeName . '</a></li><li><a>&gt;</a></li><li><a href="' . url(setPrettyUrl($courseName). '/' . $type . '/' . setPrettyUrl($className) . '/list') . '">' . $className . '</a></li><li><a>&gt;</a></li><li><a href="javascript:void(0)" class="active" >' . $subjectName . '</a></li></ul></div>';
        $tempIndexArr = array();
        foreach($testData as $test) {
            $detailContent = $test->subject_content;
            if(!empty($test->topic_id) && !in_array($test->topic_id, $tempIndexArr)) {
                $tempIndexArr[] = $test->topic_id;
                $testList[] = (object) array("is_submodule" => true, "name" => $allCourse[$test->topic_id]);
            } else if(empty($test->topic_id)){
                $testList[] = $test;
            }
        }
        return view('users.coursetypeclasssubjectalltest', compact('testList', 'courseName', 'type', 'className', 'subjectName', 'detailContent', 'urlString', 'moduleName'));
    }


    public function courseTypeCategotySubjectTopicAllTest($coursename = '', $type = '', $classname = '', $subjectname = '', $topicname = '')
    {

        $whereStr = "";
        if(!empty($coursename)) {
            $whereStr = " and name = '" . getPrettyUrl($coursename) . "'";
        }
        $courseData = \DB::select("select id,name from blog_tags where status = 1 and deleted_at is null $whereStr order by id limit 1");
        if(empty($courseData) || empty($courseData[0])) {
            echo empty($coursename)?"Server Down":"Url Does Not Exists";exit;
        }
        if(!empty($classname)) {
            $whereStr = " and name = '" . getPrettyUrl($classname) . "'";
        }
        $classData = \DB::select("select id,name from blog_categories where status = 1 and type = 1 and deleted_at is null $whereStr order by id limit 1");
        if(empty($classData) || empty($classData[0])) {
            echo empty($classname)?"Server Down":"Url Does Not Exists";exit;
        }

        if(!empty($subjectname)) {
            $whereStr = " and name = '" . getPrettyUrl($subjectname) . "'";
        }
        $subjectData = \DB::select("select id,name from blog_categories where status = 1 and type = 2 and deleted_at is null $whereStr order by id limit 1");
        if(empty($subjectData) || empty($subjectData[0])) {
            echo empty($subjectname)?"Server Down":"Url Does Not Exists";exit;
        }

        if(!empty($topicname)) {
            $whereStr = " and name = '" . getPrettyUrl($topicname) . "'";
        }
        $topicData = \DB::select("select id,name from blog_categories where status = 1 and type = 3 and deleted_at is null $whereStr order by id limit 1");
        if(empty($topicData) || empty($topicData[0])) {
            echo empty($topicname)?"Server Down":"Url Does Not Exists";exit;
        }

        $courseId   = $courseData[0]->id;
        $courseName = $courseData[0]->name;

        $classId   = $classData[0]->id;
        $className = $classData[0]->name;

        $subjectId   = $subjectData[0]->id;
        $subjectName = $subjectData[0]->name;

        $topicId   = $topicData[0]->id;
        $topicName = $topicData[0]->name;

        $statusesArr = Blog::$statusesArr;
        $typeName = $statusesArr[$type];

        $testList = array();
        $testData = \DB::select('select B.topic_content, B.status, B.name as test_name, B.id as test_id, B.content, B.status, B.featured_image from blogs B left join blog_map_tags BTM on B.id = BTM.blog_id left join blog_map_categories BMC ON BMC.blog_id = B.id where BTM.tag_id = ' . $courseId . ' and BMC.category_id = ' . $classId . ' and B.status = ' . $type . ' and B.subject_id = ' . $subjectId  . ' and B.topic_id = ' . $topicId  . ' and B.deleted_at is null');
        
        $detailContent = '';
        $moduleName = $topicName;
        $urlString = '<div class="bratekram"><ul><li><a href="/">' . $courseName . '</a></li><li><a>&gt;</a></li><li><a href="' . url(setPrettyUrl($courseName). '/' . $type . '/list') . '">' . $typeName . '</a></li><li><a>&gt;</a></li><li><a href="' . url(setPrettyUrl($courseName). '/' . $type . '/' . setPrettyUrl($className) . '/list') . '">' . $className . '</a></li><li><a>&gt;</a></li><li><a href="' . url(setPrettyUrl($courseName). '/' . $type . '/' . setPrettyUrl($className) . '/' . setPrettyUrl($subjectName) . '/list') . '">' . $subjectName . '</a></li><li><a>&gt;</a></li><li><a href="javascript:void(0)" class="active" >' . $topicName . '</a></li></ul></div>';
        foreach($testData as $test) {
            $detailContent = $test->topic_content;
            $testList[] = $test;
        }
        return view('users.coursetypeclasssubjecttopicalltest', compact('testList', 'courseName', 'type', 'className', 'subjectName', 'topicName', 'detailContent', 'urlString', 'moduleName'));
    }

    public function questionPaper($id)
    {
        $testQuestionData = \DB::select('select TQ.*, T.name as test_name from blogs T left join test_question TQ on T.id = TQ.test_id where TQ.test_id = ? and T.status = 1', array($id));
        if($testQuestionData) {
            return view('users.question_paper', compact('testQuestionData'));
        } else {
            return redirect('alltest');
        }
    }

    public function studentLogin(Request $request) {
        Session::flash('modulename', 'login'); 
        if( ctype_digit($request->email) ) {
            $request->validate([
                'email' => 'required|digits:10',
                'password' => 'required'
            ],
            [
               'email.digits'=> 'The Mobile must be 10 digits.',
            ]);
        } else {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);
        }
        $stdData = Student::select('id','name','email','class_id','course_id')->where([['email','=',$request->email],['password','=',$request->password]])->first();
        if(empty($stdData)) {
            return redirect()->back()->with('loginmsg', 'Invalid Credentials');
        }
        Session::put('studentLoggedIn', true);
        Session::put('studentData', json_encode($stdData->toArray()));
        return redirect()->back();
    }

    public function studentRegister(Request $request) {
        Session::flash('modulename', 'register'); 
        if( ctype_digit($request->email) ) {
            $request->validate([
                'name' => 'required',
                'email' => 'required|digits:10',
                'password' => 'required',
                'class_id' => 'required',
                'course_id' => 'required'
            ],
            [
               'email.digits'=> 'The Mobile must be 10 digits.',
            ]);
        } else {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required',
                'class_id' => 'required',
                'course_id' => 'required'
            ]);
        }
        $stdData = Student::select('id')->where('email',$request->email)->first();
        if(!empty($stdData)) {
            return redirect()->back()->with('registermsg', 'Email/Phone Already Registered');
        }
        $id = Student::create($request->all())->id;
        if($id) {
            $stdData = array('id'=>$id,'name'=>$request->name,'email'=>$request->email,'class_id'=>$request->class_id,'course_id'=>$request->course_id);
            Session::put('studentLoggedIn', true);
            Session::put('studentData', json_encode($stdData));
        }
        return redirect()->back();
    }

    public function studentLogout(Request $request) {
        if($request->logout == 1) {
            Session::forget('studentLoggedIn');
            Session::forget('studentData');
        }
        return redirect()->back();
    }

    public function instruction($id) {
        $testData = \DB::select('select * from blogs where id = ? and status = 2', array($id));
        if($testData) {
            $disableFooter = true;
            $testId = $id;
            return view('users.test.instructions', compact('testData','disableFooter','testId'));
        } else {
            return redirect('alltest');
        }
    }

    public function test($id) {
        $userData = json_decode(Session::get('studentData'), true);
        $testQuestionData = \DB::select('select TQ.option_1, TQ.option_2, TQ.option_3, TQ.option_4, TQ.question, TQ.serial_no, T.name as test_name from blogs T left join test_question TQ on T.id = TQ.test_id where TQ.test_id = ? and T.status = 2', array($id));
        if($testQuestionData) {
            $userId = $userData['id'];
            $attemptedTestQry = \App\AttemptedTest::select("user_id","test_id","test_answer","review_status","time_remaining","serial_no","time_status","status")->where([['user_id','=',$userId],['test_id','=',$id]])->first();
            if(empty($attemptedTestQry)) {
                $qnCount = count($testQuestionData);
                $attemptedTest = [
                    'user_id' => $userId, 'test_id' => $id, 'test_answer' => str_repeat("#",$qnCount-1), 'time_status' => str_repeat("0#",$qnCount-1)."0",
                    'review_status'=> str_repeat("0#",$qnCount-1) . "0", 'time_remaining' => 3600, "serial_no" => 1
                ];
                \App\AttemptedTest::create($attemptedTest);
            } else {
                $attemptedTest = $attemptedTestQry->toArray();
                if($attemptedTest['status'] == 1) {
                    return redirect('endtest');
                }
            }
            $disableFooter = true;
            $testId = $id;
            return view('users.test.index', compact('testQuestionData','attemptedTest','disableFooter','testId'));
        } else {
            return redirect('alltest');
        }
    }

    public function updateTest(Request $request) {
        $userData = json_decode(Session::get('studentData'), true);
        $userId = $userData['id'];
        $testId = $request->testId;
        $testData = json_decode($request->testdata, true);
        return \App\AttemptedTest::where([["test_id","=",$testId],["user_id","=",$userId]])->update($testData);
    }

    public function updateEndTest(Request $request) {
        $testId = intval($request->testId);
        $userData = json_decode(Session::get('studentData'), true);
        $userId = $userData['id'];
        $endStatus = \App\AttemptedTest::where([["test_id","=",$testId],["user_id","=",$userId]])->update(array("status"=>1));
        if($endStatus) {
            return redirect('endtest');
        }
    }

    public function endTest() {
        $disableFooter = false;
        return view('users.test.end',compact('disableFooter'));
    }

}
