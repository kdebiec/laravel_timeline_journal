<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('events.index', [
            'events' => Event::with('user')->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $eventtypes = EventType::all();
        return view('events.create', [
            'eventtypes' => $eventtypes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_name' => 'required|string|max:255',
            'short_desc' => 'required|string|max:255',
            'long_desc'  => 'required|string',
            'start_date' => 'required|date',
            "image"      => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            "event_type_id" => 'required|exists:event_types,id',
            "post_type" => 'required|string',
            "end_date" => 'nullable|string'
        ]);

        if ($request->has('post_type')) {
            if ($validated['post_type'] == 'event') {
                unset($validated['post_type']);
                $validated['is_process'] = false;
            } else {
                unset($validated['post_type']);
                $validated['is_process'] = true;
            }
        }

        if ($request->has('image')) {
            $image_path = $request->file('image')->store('image', 'public');
            $validated['image'] = $image_path;
        } else {
            $validated['image'] = "";
        }

        $request->user()->events()->create($validated);
 
        return redirect(route('events.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return view('events.show', [
            'event' => $event,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        $this->authorize('update', $event);
        $eventtypes = EventType::all();
        
        return view('events.edit', [
            'event' => $event,
            'eventtypes' => $eventtypes
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $this->authorize('update', $event);

        $validated = $request->validate([
            'event_name' => 'required|string|max:255',
            'short_desc' => 'required|string|max:255',
            'long_desc'  => 'required|string',
            'start_date' => 'required|date',
            "image"      => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            "event_type_id" => 'required|exists:event_types,id',
            "post_type" => 'required|string',
            "end_date" => 'nullable|string'
        ]);

        if ($request->has('post_type')) {
            if ($validated['post_type'] == 'event') {
                unset($validated['post_type']);
                $validated['is_process'] = false;
            } else {
                unset($validated['post_type']);
                $validated['is_process'] = true;
            }
        }
 
        $event->update($validated);
 
        return redirect(route('events.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $this->authorize('delete', $event);
        Storage::disk('public')->delete($event->image);
        $event->delete();
        return redirect(route('events.index'));
    }
}
