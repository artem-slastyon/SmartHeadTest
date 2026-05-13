<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketsRequest;
use App\Models\Scopes\TicketsFilter;
use App\Models\Ticket;
use DateTime;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TicketsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('can:edit tickets')->only(['update', 'markReplied']);
        $this->middleware('can:delete tickets')->only('destroy');
    }

    /**
     * Show tickets list.
     *
     * @return Renderable
     */
    public function index(TicketsRequest $request)
    {
        $email = $request->string('email', '');
        $phone = $request->string('phone', '');
        $dateFrom = $request->string('dateFrom', '');
        $dateTo = $request->string('dateTo', '');

        $status = $request->integer('status', -1);

        $tickets = Ticket::withGlobalScope('tickets_filter', new TicketsFilter($request));

        return view(
            'pages.tickets.index',
            [
                'email' => $email,
                'phone' => $phone,
                'status' => $status,
                'dateFrom' => $dateFrom,
                'dateTo' => $dateTo,
                'tickets' => $tickets->paginate(5)->withQueryString(),
            ]
        );
    }

    public function show(Ticket $ticket)
    {
        return view(
            'pages.tickets.show',
            [
                'ticket' => $ticket,
                'attachments' => $ticket->getMedia('attachments'),
            ]
        );
    }

    public function update(Ticket $ticket, Request $request): RedirectResponse
    {
        $data = $request->validate([
            'status' => 'int|between:0,2'
        ]);

        $ticket->update($data);

        return response()
            ->redirectToRoute('tickets.show', $ticket)
            ->with('status', 'Ticket status successfully updated!');
    }

    public function markReplied(int $ticketId): RedirectResponse
    {
        $ticket = Ticket::find($ticketId);
        $ticket->response_at = new DateTime();
        $ticket->save();

        return response()
            ->redirectToRoute('tickets.show', $ticket)
            ->with('status', 'Ticket marked as replied');
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return redirect()->route('tickets.index');
    }
}
