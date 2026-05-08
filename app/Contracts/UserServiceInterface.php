<?php

namespace App\Contracts;

use App\DTOs\User\UserRegistrationData;
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
}
