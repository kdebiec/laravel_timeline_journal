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
        $eventtypes = EventType::all();

        return view('eventtypes.index')->with('eventtypes', $eventtypes);
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
     * @param  \App\Models\EventType  $eventtype
     * @return \Illuminate\Http\Response
     */
    public function show(EventType $eventtype)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EventType  $eventtype
     * @return \Illuminate\Http\Response
     */
    public function edit(EventType $eventtype)
    {
        return view('eventtypes.edit', [
            'eventtype' => $eventtype,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EventType  $eventtype
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EventType $eventtype)
    {
        //$this->authorize('update', $eventtype);
        error_log($eventtype);
        error_log("eventtype");
 
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'color' => [
                'required',
                'string',
                'regex:/^(#[a-zA-Z0-9]{6})$/i'
            ],
        ]);
        $eventtype->update($validated);

        return redirect(route('eventtypes.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EventType  $eventtype
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, EventType $eventtype)
    {
        $eventtype->delete();
        return redirect(route('eventtypes.index'));
    }
}
