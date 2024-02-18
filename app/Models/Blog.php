<?php

namespace App\Models;

use App\Models\Traits\Attributes\BlogAttributes;
use App\Models\Traits\ModelAttributes;
use App\Models\Traits\Relationships\BlogRelationships;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends BaseModel
{
    use ModelAttributes, SoftDeletes, BlogAttributes, BlogRelationships;

    /**
     * Fillable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'publish_datetime',
        'content',
        'meta_title',
        'cannonical_link',
        'meta_keywords',
        'meta_description',
        'status',
        'featured_image',
        'topic_id',
        'subject_id',
        'topic_content',
        'subject_content',
        'subject_content',
        'class_content',
        'status_content',
        'course_content',
        'created_by',
        'updated_by',
    ];

    /**
     * Dates.
     *
     * @var array
     */
    protected $dates = [
        'publish_datetime',
        'created_at',
        'updated_at',
    ];

    /**
     * Statuses.
     *
     * @var array
     */
    protected $statuses = [
        0 => 'In Active',
        1 => 'NCERT Solutions',
        2 => 'Mock Test',
        3 => 'Important Questions',
        4 => 'Previous Year Solved Papers',
        5 => 'Content'
    ];

    public static $statusesArr = [
        0 => 'In Active',
        1 => 'NCERT Solutions',
        2 => 'Mock Test',
        3 => 'Important Questions',
        4 => 'Previous Year Solved Papers',
        5 => 'Content'
    ];

    /**
     * Appends.
     *
     * @var array
     */
    protected $appends = [
        'display_status',
    ];
}
