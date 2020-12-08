<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Mail\MailFormMailable;
use App\MailForm;
use Mail;



class MailFormController extends Controller
{
    public function index()
    {
        return view('admin.register.register_mail');
    }

    public function send(Request $request)
    {
        
        $request->validate(MailForm::$rules);
        $mailform =  new MailForm;
        $form = $request->all();
        
        unset($form['_token']);
        
        $mailform->fill($form);
        $mailform->save();
        
        
        
        
        $data = [
            'subject' => 'コメントが投稿されました',
            'name_form' => $mailform->name_form,
            'email_form' => $mailform->email_form,
            'message_form' => $mailform->message_form,
            'template' => 'email.reply_mailform',
        ];

        Mail::to('mutaerikoron@gmail.com')->send(new MailFormMailable($data));
        
        session()->flash('success', '送信いたしました！');

        return redirect('admin/register/register_mail');
    }
    
}
