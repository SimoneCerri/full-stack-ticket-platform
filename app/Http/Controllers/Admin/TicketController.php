<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ticket;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Operator;
use Illuminate\Support\Facades\Log;


class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.tickets.index', ['tickets' => Ticket::orderByDesc('id')->paginate(5)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $operators = Operator::all();
        $categories = Category::all();
        $states = ['ASSIGNED', 'IN_PROGRESS', 'CLOSED'];
        return view('admin.tickets.create', compact('categories', 'operators', 'states'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTicketRequest $request)
    {
        $validatedRequest = $request->validated();
        $title = $validatedRequest['title'];
        $ticket = Ticket::create($validatedRequest);

        return to_route('admin.tickets.index', compact('ticket'))->with('status', "Add successfully ticket '$title' !");
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        $states = ['ASSIGNED', 'IN_PROGRESS', 'CLOSED'];
        return view('admin.tickets.show', compact('ticket', 'states'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        return view('admin.tickets.edit', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
        $validatedRequest = $request->validated();
        //dd('Validated Request:', $validatedRequest);
        $ticket->update($validatedRequest);
        $title = $ticket['title'];
        //dd('Ticket Updated:', $ticket->fresh());
        return to_route('admin.tickets.index')->with('status', "Ticket '$title' updated with success !");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        $title = $ticket['title'];

        $ticket->delete();
        return to_route('admin.tickets.index')->with('status', "Deleted '$title' ticket with success..");
    }
}
