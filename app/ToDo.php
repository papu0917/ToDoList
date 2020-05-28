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
    
    public function category()
    {
        //子→親
        return $this->belongsTo('App\Category')->withDefault();
        
        
    }
    
    public function user()
    {
        return $this->belongsTo('App\User')->withDefault();
    }
}
