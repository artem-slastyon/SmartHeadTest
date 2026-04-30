<table class="table">
    <thead>
    <tr>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Role</th>
        <th scope="col">Registration time</th>
    </tr>
    </thead>

    <tbody>
    @foreach($users as /** @var \App\Models\User $user */ $user)
        <tr role="button" class="user-row" data-id="{{ $user->id }}">
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td><x-property-badge :enum="$user->getRole()"/></td>
            <td>{{ $user->created_at }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $users->links() }}

<script>
    const users = document.querySelectorAll('.user-row');

    users.forEach(ticket => {
        ticket.addEventListener('click', event => {
            window.location.href = "{{ url('/users') }}/" + event.currentTarget.dataset.id;
        })
    })
</script>
