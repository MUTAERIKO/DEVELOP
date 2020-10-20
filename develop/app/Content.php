<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    //
    protected $guarded = array('id');
    public static $rules = array(
        'title'   => 'required',
        'seireki' => 'required',
        'body'    => 'required',
        );
}
