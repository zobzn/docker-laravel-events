@extends('layout')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="btn-group pull-right">
                    <a class="btn btn-success" href="{{ route('events.index') }}">Back</a>
                </div>
                <h1 class="h4">
                    Edit Event
                </h1>
            </div>
            <div class="panel-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br />
                @endif

                <form class="form-horizontal" action="{{ route('events.update', ['id' => $event->id]) }}" method="post">
                    {{ method_field('PATCH') }}
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="col-sm-1 control-label" for="name">Title:</label>
                        <div class="col-sm-11">
                            <input class="form-control" type="text" name="title" required value="{{ $event->title }}" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-1 control-label" for="date">Date:</label>
                        <div class="col-sm-4 col-md-3">
                            <input class="form-control" type="date" name="date" required value="{{ $event->date }}" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-1 col-sm-11">
                            <button type="submit" class="btn btn-default">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
