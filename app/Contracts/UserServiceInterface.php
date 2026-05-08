<?php

namespace App\Contracts;

use App\DTOs\User\UserRegistrationData;

interface UserServiceInterface
{
    /**
     * @param UserRegistrationData $data
     * @return void
     */
    public function create(UserRegistrationData $data): void;
}
