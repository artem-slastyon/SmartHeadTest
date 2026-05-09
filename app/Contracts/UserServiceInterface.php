<?php

namespace App\Contracts;

use App\DTOs\User\UserRegistrationData;
use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserServiceInterface
{
    /**
     * @param UserRegistrationData $data
     * @return void
     */
    public function create(UserRegistrationData $data): void;

    /**
     * @return Collection<User>|User[]
     */
    public function list(): Collection|array;

    /**
     * @param int $id
     * @param UserRole $role
     * @return void
     */
    public function updateRole(int $id, UserRole $role): void;

    /**
     * @param int $id
     * @param string $password
     * @return void
     */
    public function updatePassword(int $id, #[\SensitiveParameter] string $password): void;
}
