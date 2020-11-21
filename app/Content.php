<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    //
    protected $guarded = array('id');
    public static $rules = array(
        'title'   => 'required',
        'image'   => 'required',
        'seireki' => 'required',
        'body'    => 'required',
        'user_id' => 'required',
    );

    public static $update_rules = array(
        'title'   => 'required',
        'seireki' => 'required',
        'body'    => 'required',
    );
        
    public function histories()
    {
        return $this->hasMany('App\History');
    }
    
    public function users()
    {
        return $this->belongsTo('App\User');
    }    
    
}
