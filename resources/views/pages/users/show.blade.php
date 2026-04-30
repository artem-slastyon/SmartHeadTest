@php use App\Enums\DashboardTab;use App\Enums\TicketStatus; @endphp

<x-dashboard :tab="DashboardTab::USERS">
    <div class="card mt-3 col-sm-8">

        @session('status')
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endsession

        <div class="card-body">
            <div class="row mb-4">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h4>User info</h4>
                        </div>
                        <div class="card-body">
                            <div class="row row-cols-2 mb-2">
                                <div class="col-3 text-muted">Name:</div>
                                <div class="col-4 fw-bold">{{ $user->name }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3 text-muted">Email:</div>
                                <div class="col-4 fw-bold">{{ $user->email }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3 text-muted">Role:</div>
                                <div class="col-4 fw-bold"><x-property-badge :enum="$user->getRole()"/></div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-3 text-muted">Registration date:</div>
                                <div class="col-4 fw-bold">{{ $user->created_at }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer row justify-content-end gap-2">
                <form class="form" method="post" id="delete-form" action="{{ route('users.destroy', ['user' => $user]) }}">
                    @csrf
                    @method('DELETE')
                </form>

                @can('delete users')
                    <button class="btn btn-danger col-3" type="submit" form="delete-form">Delete</button>
                @endcan
                <button class="btn btn-warning col-3" data-bs-toggle="modal" data-bs-target="#roleUpdateModal">Update
                    role
                </button>
            </div>

            <div class="modal fade" id="roleUpdateModal" tabindex="-1" aria-labelledby="roleUpdateModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="roleUpdateModalLabel">User role update</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="newRoleForm" method="post">
                                @csrf
                                @method('PATCH')
                                <div class="form-floating">
                                    <select class="form-select" id="newRoleSelect" name="role">
                                        <option {{ $user->hasRole('guest') ? 'selected' : '' }} value="guest">
                                            Guest
                                        </option>
                                        <option {{ $user->hasRole('manager') ? 'selected' : '' }} value="manager">
                                            Manager
                                        </option>
                                        <option {{ $user->hasRole('admin') ? 'selected' : '' }} value="admin">
                                            Admin
                                        </option>
                                    </select>
                                    <label for="newRoleSelect">New user role</label>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" form="newRoleForm">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard>
