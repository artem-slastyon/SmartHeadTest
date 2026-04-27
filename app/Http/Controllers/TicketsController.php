<?php

namespace App\Http\Controllers;

use App\Enums\TicketStatus;
use App\Http\Requests\TicketsRequest;
use App\Models\Ticket;
use DateTime;
use Illuminate\Contracts\Support\Renderable;

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
    }

    /**
     * Show the application dashboard.
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
            'dashboard',
            [
                'email' => $data['email'] ?? '',
                'phone' => $data['phone'] ?? '',
                'status' => $status,
                'dateFrom' => $data['dateFrom'] ?? '',
                'dateTo' => $data['dateTo'] ?? '',
                'tickets' => $ticket->paginate(5),
            ]
        );
    }

    public function show()
    {

    }
}
