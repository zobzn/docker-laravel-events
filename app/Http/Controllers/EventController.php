<?php

namespace App\Http\Controllers;

use App\Model\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $events = Event::query()
            ->where('user_id', Auth::id())
            ->orderBy('date')
            ->get();    // or ->paginate() if need split into pages

        if ($request->isXmlHttpRequest()) {
            return response()->json($events->jsonSerialize());
        } else {
            return view('events.index', compact('events'));
        }
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
     * @throws \Illuminate\Validation\ValidationException
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only('title', 'date');

        $validator = Validator::make($data, [
            'title' => 'required',
            'date'  => 'required|date_format:"Y-m-d H:i"',
        ]);

        $validator->validate();

        $event = Event::make($data);
        $event->setAttribute('user_id', Auth::id());
        $event->save();

        return redirect()
            ->route('events.index')
            ->with('success', 'Event created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param Event $event
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Http\Response
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
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Http\Response
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
     * @param Event                     $event
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
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
     * @throws \Illuminate\Auth\Access\AuthorizationException
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Event $event)
    {
        $this->authorize('event.edit', $event);

        $event->delete();

        if ($request->isXmlHttpRequest()) {
            return response()->json(true);
        } else {
            return redirect()
                ->route('events.index')
                ->with('success', 'Event deleted successfully');
        }
    }
}
