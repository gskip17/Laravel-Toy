<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests;
use App\Http\Requests\TicketFormRequest;
use App\Http\Controllers\Controller;
use App\Ticket;
use App\Comment;

class TicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = Ticket::all();

        return view('tickets.index')->with('tickets', $tickets);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tickets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TicketFormRequest $request)
    {
        $slug = uniqid();

        $ticket = new Ticket;

        $ticket->title = $request->get('title');
        $ticket->content = $request->get('content');
        $ticket->slug = $slug;

        $ticket->save();

        $data = [
            'ticket' => 'Learning Laravel'
        ];

        Mail::send('emails.ticket', $data, function($message){
            $message->from('grantskipper_2017@depauw.edu', 'Learning Laravel');

            $message->to('grantskipper_2017@depauw.edu')->subject('There is a new Ticket');
        });

        return redirect('contact')->with('status', 'Your ticket has been created! It\' unique ID is: '.$slug);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $ticket = Ticket::where('slug', $slug)->firstOrFail();
        $comments = $ticket->comments()->get();

        return view('tickets.show', compact('ticket','comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $ticket = Ticket::where('slug', $slug)->firstOrFail();

        return view('tickets.edit')->with('ticket', $ticket);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TicketFormRequest $request, $slug)
    {
        $ticket = Ticket::where('slug', $slug)->firstOrFail();

        $ticket->title = $request->get('title');
        $ticket->content = $request->get('content');

        if ($request->get('status') != null){
            $ticket->status = 0;
        } else {
            $ticket->status = 1;
        }

        $ticket->save();

        return redirect(action('TicketsController@edit', $ticket->slug))->with('status', 'The ticket '.$ticket->slug.' has been successfully updated.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $ticket = Ticket::where('slug', $slug)->firstOrFail();
        $ticket->delete();

        return redirect('/tickets')->with('status', 'Ticket: '.$slug.' has been deleted');
    }
}
