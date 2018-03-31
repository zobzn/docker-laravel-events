@extends('layout')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="btn-group pull-right">
                    <a class="btn btn-success" href="{{ route('events.index') }}">Back</a>
                </div>
                <h1 class="h4">
                    Show Event
                </h1>
            </div>
            <div class="panel-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <strong>Title:</strong>
                                {{ $event->title }}
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <strong>Date:</strong>
                                {{ $event->date }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
