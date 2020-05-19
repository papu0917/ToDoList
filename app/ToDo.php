<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ToDo extends Model
{
    protected $guarded = array('id');
    protected $dates = ['deadline_date'];
    
    
    public static $rules = array(
        'title' => 'required',
        
        // タイトルしか送らないのでタイトルだけでおOK
        // 'user_id' => 'required',
        // 'is_complete' => 'required',
    );
    
    public function categorise()
    {
        //親→子
        return $this->hasMany('App\Category'); 
        
        
    }
}
