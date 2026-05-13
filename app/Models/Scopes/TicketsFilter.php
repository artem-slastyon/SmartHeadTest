<?php

namespace App\Models\Scopes;

use App\Enums\TicketStatus;
use App\Http\Requests\TicketsRequest;
use App\Models\Ticket;
use DateTime;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class TicketsFilter implements Scope
{
    public function __construct(
        private TicketsRequest $request
    ) {
    }


    /**
     * Apply the scope to a given Eloquent query builder.
     * @param Builder<Ticket> $builder
     * @param Ticket $model
     * @return void
     */
    public function apply(Builder $builder, Model $model): void
    {
        $data = $this->request->validated();
        $status = -1;

        if (isset($data['status'])) {
            $status = intval($data['status']);
        }

        if (isset($data['email'])) {
            $builder->whereCustomerEmailContains($data['email']);
        }

        if (isset($data['phone'])) {
            $builder->whereCustomerPhoneContains($data['phone']);
        }

        if (isset($data['status']) && $status !== -1) {
            $builder->withStatus(TicketStatus::from($status));
        }

        if (isset($data['dateFrom'])) {
            try {
                $builder->whereWasCreatedAfter(new DateTime($data['dateFrom']));
            } catch (\DateMalformedStringException $e) {
                report($e);
            }
        }

        if (isset($data['dateTo'])) {
            try {
                $builder->whereWasCreatedBefore(new DateTime($data['dateTo']));
            } catch (\DateMalformedStringException $e) {
                report($e);
            }
        }
    }
}
