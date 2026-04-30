<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $currentUser = Auth::user();

        if ($user->id === $currentUser->id) {
            return redirect()->route('users.show', ['user' => $user])
                ->with('status-color', 'danger')
                ->with('status', "You can't remove yourself!");
        }

        $user->delete();

        return redirect()->route('users.index');
    }

    public function update(User $user, Request $request)
    {
        $data = $request->validate([
            'role' => 'string|in:guest,manager,admin'
        ]);

        $user->syncRoles($data['role']);

        return response()
            ->redirectToRoute('users.show', $user)
            ->with('status', 'User role was successfully changed');
    }
}
