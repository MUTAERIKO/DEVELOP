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
        'googlemap'    => 'required',
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
    
    public function user()
    {
        return $this->belongsTo('App\User');
    } 
    
    public function questions()
    {
        return $this->hasMany('App\Question');
    }
    
    public function favorite_users()
    {
        return $this->belongsToMany(User::class,'favorites','content_id','user_id')->withTimestamps();
    }

    
}
