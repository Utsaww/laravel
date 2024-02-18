<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestQuestion extends Model
{
    protected $table = 'test_question';
    protected $fillable = ['serial_no','test_code','test_id','question','option_1','option_2','option_3','option_4','answer','solution'];
}
