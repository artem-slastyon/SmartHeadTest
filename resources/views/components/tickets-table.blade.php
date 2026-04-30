<div class="container" id="filterContainer">
    @if(session('filterError'))
        <div class="alert alert-danger" role="alert">
            {{ session('filterError') }}
        </div>
    @endif

    <form class="row mb-3 align-items-center">
        <div class="col">
            <div class="form-floating">
                <input type="text" class="form-control" id="emailFilter"
                       placeholder="test@example.com" name="email" value="{{ $emailFilter }}"/>
                <label for="emailFilter">Email</label>
            </div>
        </div>

        <div class="col">
            <div class="form-floating">
                <input type="text" class="form-control" id="phoneFilter" name="phone" value="{{ $phoneFilter }}"/>
                <label for="phoneFilter">Phone</label>
            </div>
        </div>

        <div class="col">
            <div class="form-floating">
                <select class="form-select" id="statusFilter" name="status">
                    <option {{ $statusFilter === -1 ? 'selected' : '' }} value="-1">Any status</option>
                    <option {{ $statusFilter === 0 ? 'selected' : '' }} value="0">New</option>
                    <option {{ $statusFilter === 1 ? 'selected' : '' }} value="1">In Progress</option>
                    <option {{ $statusFilter === 2 ? 'selected' : '' }} value="2">Resolved</option>
                </select>
                <label for="statusFilter">Status</label>
            </div>
        </div>

        <div class="col">
            <div class="form-floating">
                <input class="form-control" type="date" id="dateFilterFrom" name="dateFrom" value="{{ $dateFrom }}"/>
                <label for="dateFilter">From Date</label>
            </div>
        </div>

        <div class="col">
            <div class="form-floating">
                <input class="form-control" type="date" id="dateFilterTo" name="dateTo" value="{{ $dateTo }}"/>
                <label for="dateFilter">To Date</label>
            </div>
        </div>

        <div class="col-auto">
            <button type="submit" class="btn btn-primary btn-lg">Filter</button>
        </div>
    </form>
</div>

<table class="table">
    <thead>
    <tr>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Phone</th>
        <th scope="col">Subject</th>
        <th scope="col">Status</th>
        <th scope="col">Creation time</th>
        <th scope="col">Response time</th>
    </tr>
    </thead>

    <tbody>
    @foreach($tickets as $ticket)
        <tr role="button" class="ticket-row" data-id="{{ $ticket->id }}">
            <td>{{ $ticket->customer->name }}</td>
            <td>{{ $ticket->customer->email }}</td>
            <td>{{ $ticket->customer->phone }}</td>
            <td>{{ $ticket->subject }}</td>
            <td><x-property-badge :enum="$ticket->status"/></td>
            <td>{{ $ticket->created_at }}</td>
            <td>{{ $ticket->response_at }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $tickets->links() }}

<script>
    const tickets = document.querySelectorAll('.ticket-row');

    tickets.forEach(ticket => {
        ticket.addEventListener('click', event => {
            window.location.href = "{{ url('/tickets') }}/" + event.currentTarget.dataset.id;
        })
    })
</script>
