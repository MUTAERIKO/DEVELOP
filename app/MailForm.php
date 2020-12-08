<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MailForm extends Model
{
    protected $table = 'mailform';
    
    protected $guarded = array('id');
    public static $rules = array(
        'name_form'   => 'required',
        'email_form'   => 'required',
        'message_form' => 'required',
    );
}
