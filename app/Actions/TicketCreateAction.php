<?php

namespace App\Actions;

use App\DTOs\Ticket\TicketCreationData;
use App\Models\Customer;

class TicketCreateAction
{
    public function execute(TicketCreationData $data): void
    {
        $customer = Customer::firstOrCreate(
            [
                'email' => $data->email,
            ],
            [
                'name' => $data->name,
                'email' => $data->email,
                'phone' => $data->phone
            ]
        );

        $ticket = $customer->tickets()->create([
            'subject' => $data->subject,
            'text'    => $data->text
        ]);

        foreach ($data->files as $file) {
            $ticket->addMedia($file)->toMediaCollection('attachments');
        }
    }
}
