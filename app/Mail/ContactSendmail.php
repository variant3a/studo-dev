<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactSendmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $category;
    protected $email;
    protected $title;
    protected $content;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $inputs )
    {
        $this->category = $inputs['category'];
        $this->email = $inputs['email'];
        $this->title = $inputs['title'];
        $this->content = $inputs['content'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from('teamstudo.info@gmail.com')
            ->subject( __('Automatically send email') )
            ->markdown('contact.mail')
            ->with([
                'category' => $this->category,
                'email' => $this->email,
                'title' => $this->title,
                'content' => $this->content,
            ]);
    }
}
