<?php

namespace App\Services;

use App\Contracts\UserServiceInterface;
use App\DTOs\User\UserRegistrationData;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserService implements UserServiceInterface
{
    /**
     * @param UserRegistrationData $data
     * @return void
     */
    public function create(UserRegistrationData $data): void
    {
        $role = $data->role;

        if (is_null($role)) {
            $role = UserRole::GUEST;
        }

        User::create([
            'email' => $data->email,
            'name' => $data->name,
            'password' => $data->password,
        ])->assignRole($role);
    }

    /**
     * @return Collection<User>|User[]
     */
    public function list(): Collection|array
    {
        return User::all();
    }
}
