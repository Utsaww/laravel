<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttemptedTest extends Model
{
    protected $table = 'attempted_test';
    protected $fillable = ['user_id','test_id','test_answer','review_status','time_status','time_remaining','status'];
}
