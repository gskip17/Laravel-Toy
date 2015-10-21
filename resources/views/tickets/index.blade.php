@extends('master')
@section('title', 'View All Tickets')
@section('content')

<div class="container col-md-8 col-md-offset-2">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>Tickets</h2>
        </div>
        @if($tickets->isEmpty())
            <p>There are no tickets.</p>
        @else
        @if(session('status'))
            <p class='alert alert-success text-center'>{!! session('status') !!}</p>
        @endif
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Slug</th>
                        <th>Create Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tickets as $ticket)
                        <tr>
                            <td>{!! $ticket->id !!}</td>
                            <td><a href="tickets/{!!$ticket->slug!!}">{!! $ticket->title !!}</a></td>
                            <td>{!! $ticket->status ? 'Pending' : 'Answered' !!}</td>
                            <td>{!! $ticket->slug !!}</td>
                            <td>{!! $ticket->created_at !!}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection