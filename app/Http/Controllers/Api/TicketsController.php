<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TicketCreateRequest;
use App\Models\Customer;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(TicketCreateRequest $request)
    {
        $data = $request->validated();

        $customer = Customer::firstOrCreate(
            [
                'email' => $data['email'],
            ],
            [
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'] ?? null,
            ]
        );

        $ticket = $customer->tickets()->create([
            'subject' => $data['subject'],
            'text' => $data['text'],
        ]);
    }
}
