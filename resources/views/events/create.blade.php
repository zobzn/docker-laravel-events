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
                                <div class="col-sm-6">
                                    <input class="form-control" type="date" name="date" required />
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10 ml-auto">
                                    <button type="submit" class="btn btn-default">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
