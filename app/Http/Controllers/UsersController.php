<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
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
}
