<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ToDo extends Model
{
    protected $guarded = array('id');

    
    public static $rules = array(
        'title' => 'required',
        // タイトルしか送らないのでタイトルだけでおOK
        // 'user_id' => 'required',
        // 'is_complete' => 'required',
    );
}
