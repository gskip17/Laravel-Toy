@extends('master')
@section('title', 'Contact')
@section('content')

<div class="container col-md-8 col-md-offset-2">
    <div class="well well bs-component">
            @foreach($errors->all() as $error)
                <p class="alert alert-danger">{{$error}}</p>
            @endforeach
            @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <form class="form-horizontal" method="post">
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                <fieldset>
                <legend>Submit a new ticket</legend>
                <div class="form-group">
                    <label for="title" class="col-lg-2 control-label">Title</label>
                    <div class="col-lg-10">
                        <input name='title' type="text" class="form-control" id="title" placeholder="Title" value="{!! $ticket->title !!}">
                    </div>
                </div>
                    <div class="form-group">
                        <label for="content" class="col-lg-2 control-label">Content</label>
                        <div class="col-lg-10">
                            <textarea name='content' class="form-control" rows="3" id="content">{!! $ticket->content !!}</textarea>
                            <span class="help-block">Feel free to ask us any question.</span>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <label>
                            <input type="checkbox" name="status" {!! $ticket->status?"":"checked"!!} > Close this ticket?
                        </label>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <a href="/tickets/{!! $ticket->slug !!}" class="btn btn-default">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>

@endsection