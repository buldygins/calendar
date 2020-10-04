<?php

namespace App\Mail;

use App\Models\Event;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EventMail extends Mailable
{
    use Queueable, SerializesModels;

    public $creator;
    public $event;
    public $manager;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $manager,Event $event, User $creator)
    {
        $this->event = $event;
        $this->manager = $manager;
        $this->creator = $creator;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->text('mail.create_event_mail');
    }
}
