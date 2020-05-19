<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = array('id');

    public static $rules = array(
        'name' => 'required',
    );
    
    public function todo()
    {
        // 子→親
        return $this->belongsTo('App\ToDo');
        
    }
}
