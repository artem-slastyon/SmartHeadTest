<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:edit users')->only('update');
        $this->middleware('can:delete users')->only('destroy');
    }

    public function index()
    {
        return view(
            'pages.users.index',
            [
                'users' => User::paginate(5),
            ]
        );
    }

    public function show(User $user)
    {
        return view(
            'pages.users.show',
            [
                'user' => $user,
            ]
        );
    }

    public function destroy(User $user)
    {
        $gateResponse = Gate::inspect('delete', $user);

        if (!$gateResponse->allowed()) {
            return redirect()->route('users.show', ['user' => $user])
                ->with('status-color', 'danger')
                ->with('status', $gateResponse->message());
        }

        $user->delete();

        return redirect()->route('users.index');
    }

    public function update(User $user, Request $request)
    {
        $gateResponse = Gate::inspect('update', $user);

        if (!$gateResponse->allowed()) {
            return redirect()->route('users.show', ['user' => $user])
                ->with('status-color', 'danger')
                ->with('status', $gateResponse->message());
        }

        $data = $request->validate([
            'role' => 'string|in:guest,manager,admin'
        ]);

        $user->syncRoles($data['role']);

        return response()
            ->redirectToRoute('users.show', $user)
            ->with('status', 'User role was successfully changed');
    }
}
