@php use App\Enums\DashboardTab;use App\Enums\TicketStatus; @endphp

<x-dashboard :tab="DashboardTab::TICKETS">
    <div class="card mt-3 col-sm-8">

        @session('status')
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endsession

        <div class="card-body">
            <h5 class="card-title">{{ $ticket->subject }}</h5>
            <div class="row mb-4">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h4>Customer info</h4>
                        </div>
                        <div class="card-body">
                            <div class="row row-cols-2 mb-2">
                                <div class="col-3 text-muted">Name:</div>
                                <div class="col-4 fw-bold">{{ $ticket->customer->name }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3 text-muted">Email:</div>
                                <div class="col-4 fw-bold">{{ $ticket->customer->email }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3 text-muted">Phone number:</div>
                                <div class="col-4 fw-bold">{{ $ticket->customer->phone }}</div>
                            </div>
                            <div class="row align-items-center mb-2">
                                <div class="col-3 text-muted">Status:</div>
                                <x-status-badge class="col-3 fs-6" :status="$ticket->status"/>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3 text-muted">Response time:</div>
                                <div class="col-4 fw-bold">{{ $ticket->response_at }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <h4>Ticket text:</h4>

            <p class="card-text">{{ $ticket->text }}</p>

            <h4 class="card-title">Attachments ({{ $attachments->count() }}):</h4>

            @if($attachments->count() > 0)
                <x-files-table :attachments="$attachments"/>
            @endif

            <div class="card-footer row justify-content-end gap-2">
                <form class="form" method="post" id="mark-form" action="{{ route('tickets.mark', ['id' => $ticket->id]) }}">
                    @csrf
                </form>

                <form class="form" method="post" id="delete-form" action="{{ route('tickets.destroy', ['ticket' => $ticket]) }}">
                    @csrf
                    @method('DELETE')
                </form>

                @can('delete tickets')
                    <button class="btn btn-danger col-3" type="submit" form="delete-form">Delete</button>
                @endcan
                <button class="btn btn-success col-3" type="submit" form="mark-form">Mark replied</button>
                <button class="btn btn-warning col-3" data-bs-toggle="modal" data-bs-target="#statusUpdateModal">Update
                    status
                </button>
            </div>

            <div class="modal fade" id="statusUpdateModal" tabindex="-1" aria-labelledby="statusUpdateModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="statusUpdateModalLabel">Ticket status update</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="newStatusForm" method="post">
                                @csrf
                                @method('PATCH')
                                <div class="form-floating">
                                    <select class="form-select" id="newStatusSelect" name="status">
                                        <option {{ $ticket->status === TicketStatus::NEW ? 'selected' : '' }} value="0">
                                            New
                                        </option>
                                        <option {{ $ticket->status === TicketStatus::IN_PROGRESS ? 'selected' : '' }} value="1">
                                            In Progress
                                        </option>
                                        <option {{ $ticket->status === TicketStatus::RESOLVED ? 'selected' : '' }} value="2">
                                            Resolved
                                        </option>
                                    </select>
                                    <label for="newStatusSelect">New status</label>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" form="newStatusForm">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard>
