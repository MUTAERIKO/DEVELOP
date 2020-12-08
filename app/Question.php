<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded = array('id');
    
    public static $rules = array(
        // 'content_id' => 'required',
        // 'toukou' => 'required',
        );
        
    public function content()
    {
        return $this->belongsTo('App\Content');
    } 
    
}
