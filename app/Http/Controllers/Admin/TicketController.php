<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ticket;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Operator;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;


class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $status = $request->get('status');
        $categoryId = $request->get('category_id');

        $tickets = Ticket::query();

        if ($status) {
            $tickets->where('status', $status);
        }

        if ($categoryId) {
            $tickets->where('category_id', $categoryId);
        }

        $tickets = $tickets->orderBy('created_at', 'desc')->with(['category', 'operator'])->paginate(10);

        $categories = Category::all();

        return view('admin.tickets.index', compact('tickets', 'categories'));
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
        $operators = Operator::all();
        $categories = Category::all();
        $states = ['ASSIGNED', 'IN_PROGRESS', 'CLOSED'];

        return view('admin.tickets.edit', compact('ticket', 'states', 'categories', 'operators'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        if ($request->has('status') && !$request->hasAny(['title', 'description', 'category_id', 'operator_id'])) {
            $validated = $request->validate([
                'status' => 'required|in:ASSIGNED,IN_PROGRESS,CLOSED',
            ]);

            $ticket->update($validated);

            return to_route('admin.tickets.index')->with('status', "Ticket status updated successfully.");
        }

        $validated = $request->validate([
            'title' => 'required|min:10|max:50',
            'description' => 'required|min:10|max:255',
            'status' => 'required|in:ASSIGNED,IN_PROGRESS,CLOSED',
            'category_id' => 'required|exists:categories,id',
            'operator_id' => 'required|exists:operators,id',
        ]);

        $ticket->update($validated);

        return to_route('admin.tickets.index')->with('status', "Ticket '{$ticket->title}' updated successfully.");
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
