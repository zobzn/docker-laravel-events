@extends('layout')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="btn-group pull-right">
                    <a class="btn btn-success" href="{{ route('events.create') }}"> Create New Event</a>
                </div>
                <h1 class="h4">
                    Events
                </h1>
            </div>
            <div class="panel-body">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                @if (!count($events))
                    <p>
                        You have no events yet.
                    </p>
                @endif
                @if (count($events))
                    <table class="table">
                        <colgroup>
                            <col />
                            <col />
                            <col width="160" />
                            <col width="190" />
                        </colgroup>
                        <thead>
                            <tr>
                                <td>Id</td>
                                <td>Title</td>
                                <td>Date</td>
                                <td>Actions</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($events as $event)
                                <tr>
                                    <td>
                                        {{ $event->id }}
                                    </td>
                                    <td>
                                        {{ $event->title }}
                                    </td>
                                    <td>
                                        {{ $event->date }}
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-primary" href="{{ route('events.show', ['id' => $event->id]) }}">Show</a>
                                        <a class="btn btn-sm btn-success" href="{{ route('events.edit', ['id' => $event->id]) }}">Edit</a>
                                        <form method="post" style="display: inline;" action="{{ route('events.destroy', ['id' => $event->id]) }}">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{--
                    {!! $events->links() !!}
                    --}}
                @endif
            </div>
        </div>

        @if (count($events))
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="fullcalendar" data-events='@json($events)'></div>
                </div>
            </div>
        @endif
    </div>
@endsection
