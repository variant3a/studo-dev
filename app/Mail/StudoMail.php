<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StudoMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $title;
    protected $content;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $content, $data)
    {
        $this->title = sprintf('%s様', $name);
        $this->conetent = $content;
        $this->data = $data;
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
            ->subject($this->title)
            ->view('mail.send', compact('content', 'data'));
    }
}
