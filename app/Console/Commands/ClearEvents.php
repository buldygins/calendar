<?php

namespace App\Console\Commands;

use App\Models\Event;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class ClearEvents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "events:clear {--date=}";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete all the events in the past';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $date = $this->option('date');
        if (empty($date)){
            $date = Carbon::now()->format("Y-m-d");
        }
        $events = Event::all()->where('date','<', $date);
        foreach ($events as $event){
            $event->destroy($event->id);
        }
        $this->info('deleted '.count($events). ' events' );
    }
}
