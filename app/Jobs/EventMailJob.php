<?php

namespace App\Jobs;

use App\Mail\EventMail;
use App\Models\Event;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class EventMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $event;
    public $manager;
    public $creator;
    /**
     * Create a new job instance.
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
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        return Mail::to($this->manager->email)->send(new EventMail($this->manager ,$this->event, $this->creator));
    }
}
