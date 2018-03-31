@extends('layout')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="btn-group pull-right">
                    <a class="btn btn-success" href="{{ route('events.index') }}">Back</a>
                </div>
                <h1 class="h4">
                    Show Event
                </h1>
            </div>
            <div class="card-body">
                <p>
                    <strong>Title:</strong>
                    {{ $event->title }}
                </p>
                <p>
                    <strong>Date:</strong>
                    {{ $event->date }}
                </p>
            </div>
        </div>
    </div>
@endsection
