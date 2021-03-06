<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Jobs\EventMailJob;
use App\Models\Company;
use App\Models\Event;
use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['only' => ['create', 'store', 'destroy', 'edit', 'update']]);
    }
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
        $event = Event::create($request->validated());
        EventMailJob::dispatch($event->user, $event, Auth::user());
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
        return view('events.event', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Event $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        $companies = Company::all()->except(['id' => $event->company->id]);
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
        $event->delete();
        return redirect()->route('event.index', $event->company->id);
    }

    /**
     * Outputs available shift for requested company on date.
     *
     * @param $company_id
     * @param $date
     * @return array
     *
     */

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

    /**
     * Returns
     *
     * @return Event[]|\Illuminate\Database\Eloquent\Collection
     */

    public function EventTable()
    {
        return Event::all();
    }


    public function apiDestroy(Event $event)
    {
        return response()->json($event->delete());
    }
}
