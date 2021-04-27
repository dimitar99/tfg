<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = "Formulario de contacto";
    private $request, $body;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($request, $body)
    {
        $this->request = $request;
        $this->body = $body;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $body = $this->body;
        $user = $this->request->user();
        return $this->view('mails.contact', compact('body', 'user'));
    }
}
