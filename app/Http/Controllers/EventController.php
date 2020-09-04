<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Company;
use App\Models\Event;
use App\Models\Shift;
use http\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use SimplePie;
use willvincent\Feeds\Facades\FeedsFacade;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::with('events.user')->get();
        $shifts = Shift::all();
        return view('events.all', compact(['companies', 'shifts']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::all();
        $shifts = Shift::all();
        return view('events.create', compact('companies', 'shifts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request)
    {
        Event::create($request->validated());
        return redirect()->route('event.index', 1);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        $companies = Company::all();
        return view('events.edit', compact(['event', 'companies']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function update(EventRequest $request, Event $event)
    {
        $event->update($request->validated());
        return redirect()->route('event.index', $event->company->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        Event::find($event->id)->delete();
        return redirect()->route('event.index', $event->company->id);
    }

    public function checkAvailableShifts($company_id, $date)
    {
        $events_this_date = Event::where('company_id', $company_id)->where('date', $date)->get();
        $shifts = Shift::all();
        foreach ($shifts as $shift) {
            $diff[$shift->id] = $shift->name;
        }
        foreach ($events_this_date as $event) {
            $data[$event->shift->id] = $event->shift->name;
        }
        if (isset($data)) {
            $response = array_diff($diff, $data);
            return $response;
        } else {
            return $diff;
        }
    }

    public function xmlEvents($id)
    {
        //$events = Event::where('company_id',$id)->get();
        $events = Company::find($id)->events;
        return response()->view('test', compact('events'))->header('Content-type', 'text/xml');
    }

    public function xmlParse($id, $attribute = 0)
    {
        $simp = new SimplePie();
        $simp->set_feed_url('http://events/test/' . $id);
        $simp->set_cache_location(storage_path('framework/cache'));
        $simp->set_cache_duration();
        $simp->init();
        dump($simp->get_title());
        Log::channel('single')->info(view('file', compact('simp')));
//        $feed = FeedsFacade::make('http://events/test/' . $id);
//        // dd($simp);
//        $items = $feed->get_items();
//        dump($feed->get_title());
//        foreach ($items as $item) {
//            dump($item->get_title());
//            dump($item->get_description());
//        }
    }

    public function companies()
    {
        dd(Company::has('events')->get());
    }
}
