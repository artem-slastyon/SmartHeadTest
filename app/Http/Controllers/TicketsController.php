<?php

namespace App\Http\Controllers;

use App\Enums\TicketStatus;
use App\Http\Requests\TicketsRequest;
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
        $data = $request->validated();
        $status = -1;

        if (isset($data['status'])) {
            $status = intval($data['status']);
        }

        $ticket = Ticket::query();

        if (isset($data['email'])) {
            $ticket->whereCustomerEmailContains($data['email']);
        }

        if (isset($data['phone'])) {
            $ticket->whereCustomerPhoneContains($data['phone']);
        }

        if (isset($data['status']) && $status !== -1) {
            $ticket->withStatus(TicketStatus::from($status));
        }

        if (isset($data['dateFrom'])) {
            try {
                $ticket->whereWasCreatedAfter(new DateTime($data['dateFrom']));
            } catch (\DateMalformedStringException $e) {
                report($e);
            }
        }

        if (isset($data['dateTo'])) {
            try {
                $ticket->whereWasCreatedBefore(new DateTime($data['dateTo']));
            } catch (\DateMalformedStringException $e) {
                report($e);
            }
        }

        return view(
            'pages.tickets.index',
            [
                'email' => $data['email'] ?? '',
                'phone' => $data['phone'] ?? '',
                'status' => $status,
                'dateFrom' => $data['dateFrom'] ?? '',
                'dateTo' => $data['dateTo'] ?? '',
                'tickets' => $ticket->paginate(5)->withQueryString(),
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
