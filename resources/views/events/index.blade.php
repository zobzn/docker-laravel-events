@extends('layout')

@section('content')
    <div class="container vue-app">
        <div class="card my-4">
            <div class="card-header">
                <div class="btn-group pull-right">
                    <a class="btn btn-success" href="{{ route('events.create') }}"> Create New Event</a>
                </div>
                <h1 class="h4">
                    Events
                </h1>
            </div>
            <div class="card-body">
                @if ($message = Session::get('success'))
                    <p class="alert alert-success">
                        {{ $message }}
                    </p>
                @endif

                <events-list v-bind:events='@json($events)'></events-list>
            </div>
        </div>

        @if (count($events))
            <div class="card my-4">
                <div class="card-body">
                    <div class="fullcalendar" data-events='@json($events)'></div>
                </div>
            </div>
        @endif
    </div>
@endsection
