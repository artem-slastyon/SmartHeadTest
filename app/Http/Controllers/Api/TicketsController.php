<?php

namespace App\Http\Controllers\Api;

use App\Actions\TicketCreateAction;
use App\Actions\TicketsStatisticAction;
use App\DTOs\Ticket\TicketCreationData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TicketCreateRequest;
use App\Mappers\TicketStatisticMapper;
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

        $action = new TicketCreateAction();

        $action->execute(
            new TicketCreationData(
                $data['email'],
                $data['name'],
                $data['phone'] ?? null,
                $data['subject'],
                $data['text'],
                $request->file('files', []),
            ),
        );

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
