<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use SimplePie;

class RssController extends Controller
{

    /**
     * Making an XML document of all events of exact company
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function xmlEvents($id)
    {
        $events = Company::findOrFail($id)->events;
        return response()->view('test', compact('events'))->header('Content-type', 'text/xml');
    }

    /**
     * Parse the XML document to log
     * @param $id
     * @return Illuminate\Support\Facades\Log
     */
    public function xmlParseToLog($id)
    {
        $simp = new SimplePie();
        $simp->set_feed_url(route('xmlEvents', $id));
        $simp->set_cache_location(storage_path('framework/cache'));
        $simp->set_cache_duration();
        $simp->init();
        Log::channel('rss')->info(view('file', compact('simp')));
    }
}
