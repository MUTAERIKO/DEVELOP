<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailFormMailable extends Mailable
{
    protected $table = 'mailform';
    
    
    
    
    use Queueable, SerializesModels;
    
    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view($this->data['template'])
            ->subject($this->data['subject'])
            ->from($this->data['email_form'], $this->data['name_form'])
            ->with('data', $this->data);
    }
}
