<?php

namespace App\Services;

use App\Contracts\UserServiceInterface;
use App\DTOs\User\UserRegistrationData;
use App\Enums\UserRole;
use App\Exceptions\UserException;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

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

    /**
     * @param int $id
     * @param UserRole $role
     * @return void
     * @throws UserException
     */
    public function updateRole(int $id, UserRole $role): void
    {
        $user = $this->getUser($id);

        $user->syncRoles($role);
    }

    /**
     * @param int $id
     * @param string $password
     * @return void
     * @throws UserException
     */
    public function updatePassword(int $id, #[\SensitiveParameter] string $password): void
    {
        $user = $this->getUser($id);

        $user->password = Hash::make($password);
        $user->save();
    }

    /**
     * @param int $id
     * @return User
     * @throws UserException
     */
    private function getUser(int $id): User
    {
        $user = User::find($id);

        if (is_null($user)) {
            throw UserException::userNotFound();
        }

        return $user;
    }
}
