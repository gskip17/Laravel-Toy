@extends('master')
@section('title','Ticket: '.$ticket->slug)
@section('content')

<div class="container col-md-8 col-md-offset-2">
    <div class="well well bs-component">
        <div class="content">
            <h2 class="header">{!! $ticket->title !!}</h2>
            <p><strong>Status: </strong>{!! $ticket->status ? 'Pending' : 'Answered' !!}</p>
            <p>{!! $ticket->content !!}</p>
        </div>
        <a href="{!! action('TicketsController@edit', $ticket->slug) !!}" class="btn btn-info">Edit</a>
        <a href="{!! action('TicketsController@destroy', $ticket->slug) !!}" class="btn btn-danger">Delete</a>
    </div><!-- End Ticket -->
    <div class="well well bs-component">
      <h4>Comments</h4>
    @foreach($comments as $comment)
    <div class="well well bs-component">
        <div class="content">
            {!! $comment->content !!}
        </div>
    </div>
    @endforeach <!-- End of Show Comments -->
    </div>
    <div class="well well bs-component">
      <form class="form-horizontal" method="post" action="/comment">
        @foreach($errors->all() as $error)
          <p class="alert alert-danger">{{ $error }}</p>
        @endforeach
    @if(session('status'))
    <div class="alert alert-success">
          {{ session('status') }}
    </div>
          @endif
    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
    <input type="hidden" name="post_id" value="{!! $ticket->id !!}">
    <fieldset>
        <legend>Reply</legend>
        <div class="form-group">
          <div class="col-lg-12">
            <textarea class="form-control" rows="3" id="content"\name="content"></textarea>
          </div>
    </div>
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2 pull-left">
                    <button type="reset" class="btn btn-default">Cancel</button>
                    <button type="submit" class="btn btn-primary">Post</button>
                </div>
            </div>
        </fieldset>
    </form>
    </div>
</div><!-- End of Comment Form -->
@endsection
