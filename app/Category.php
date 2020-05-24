<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = array('id');

    public static $rules = array(
        'name' => 'required',
    );
    
    public function todos()
    {
        // 親→子
        return $this->hasMany('App\ToDo');
        
    }
}
