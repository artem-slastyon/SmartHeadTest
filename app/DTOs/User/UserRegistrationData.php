<?php

namespace App\DTOs\User;

use App\Enums\UserRole;

readonly class UserRegistrationData
{

    public function __construct(
        public string $email,
        public string $name,
        public string $password,
        public ?UserRole $role
    )
    {
    }
}
