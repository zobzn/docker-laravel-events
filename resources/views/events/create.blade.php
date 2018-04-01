@extends('layout')

@section('content')
    <div class="container my-4">
        <div class="row">
            <div class="col-md-8 col-lg-6 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="btn-group pull-right">
                            <a class="btn btn-success" href="{{ route('events.index') }}">Back</a>
                        </div>
                        <h1 class="h4">
                            Create Event
                        </h1>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div><br />
                        @endif

                        <form action="{{ route('events.store') }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <label class="col-sm-2 control-label" for="name">Title:</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="title" required />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 control-label" for="date">Date:</label>
                                <div class="col-sm-10">
                                    <div class="input-group date" id="event-date" data-target-input="nearest">
                                        <input class="form-control datetimepicker-input" type="text"
                                               data-target="#event-date" data-toggle="datetimepicker" data-dt-format="YYYY-MM-DD HH:mm"
                                               name="date" required />
                                        <div class="input-group-append" data-target="#event-date" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10 ml-auto">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
