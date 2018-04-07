<?php

namespace App\Http\Controllers;

use App\Model\Event;
use Fig\Http\Message\StatusCodeInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::query()
            ->where('user_id', Auth::id())
            ->orderBy('date')
            ->get();    // or ->paginate() if need split into pages

        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'date'  => 'required|date_format:"Y-m-d H:i"',
        ]);

        $event = Event::make($request->all());
        $event->setAttribute('user_id', Auth::id());
        $event->save();

        return redirect()
            ->route('events.index')
            ->with('success', 'Event created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Event $event)
    {
        $this->authorize('event.view', $event);

        return view('events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Event $event)
    {
        $this->authorize('event.edit', $event);

        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $this->authorize('event.edit', $event);

        $request->validate([
            'title' => 'required',
            'date'  => 'required|date_format:"Y-m-d H:i"',
        ]);

        $event->update($request->all());

        return redirect()
            ->route('events.index')
            ->with('success', 'Event updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Event $event)
    {
        $this->authorize('event.edit', $event);

        $event->delete();

        return redirect()
            ->route('events.index')
            ->with('success', 'Event deleted successfully');
    }
}
