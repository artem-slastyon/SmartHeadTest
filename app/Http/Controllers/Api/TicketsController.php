<?php

namespace App\Http\Controllers\Api;

use App\Actions\TicketsStatisticAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TicketCreateRequest;
use App\Mappers\TicketStatisticMapper;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;

class TicketsController extends Controller
{
    public function __construct(private TicketsStatisticAction $statisticAction)
    {
    }

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

        if ($request->files->count() > 0) {
            foreach ($request->file('files') as $file) {
                $ticket->addMedia($file)->toMediaCollection('attachments');
            }
        }

        return response()->json([
            'status' => 'ok'
        ]);
    }

    public function statistics(): JsonResponse
    {
        $statistic = $this->statisticAction->execute();

        return response()->json(TicketStatisticMapper::fromDto($statistic));
    }
}
