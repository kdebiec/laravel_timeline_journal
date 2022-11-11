<?php

namespace App\Http\Controllers;

use App\Models\EventType;
use Illuminate\Http\Request;

class EventTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $event_types = EventType::all();

        return view('eventtypes.index')->with('event_types', $event_types);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'color' => [
                'required',
                'string',
                'regex:/^(#[a-zA-Z0-9]{6})$/i'
            ],
        ]);
 
        EventType::create($request->all());
 
        return redirect(route('eventtypes.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EventType  $eventType
     * @return \Illuminate\Http\Response
     */
    public function show(EventType $eventType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EventType  $eventType
     * @return \Illuminate\Http\Response
     */
    public function edit(EventType $eventType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EventType  $eventType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EventType $eventType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EventType  $eventType
     * @return \Illuminate\Http\Response
     */
    public function destroy(EventType $eventType)
    {
        //$this->authorize('delete', $eventType);
        // if ($eventType->id == 6) {
        //     return redirect(route('2'));
        // } else {
        //     return redirect(route('5'));
        // }

        $eventType->delete();
        //EventType::destroy([$eventType->id]);
        //EventType::find($eventType->id)->delete();
        return redirect(route('eventtypes.index'));
    }
}
