<?php

namespace App\Console\Commands\User;

use App\Console\Commands\AbstractCommand;
use App\Contracts\UserServiceInterface;
use App\DTOs\User\UserRegistrationData;
use App\Enums\UserRole;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class CreateUserCommand extends AbstractCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create {email} {name} {password} {role=manager}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create user';

    public function __construct(private UserServiceInterface $userService)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $validator = Validator::make($this->arguments(),
        [
            'email' => 'email',
            'name' => 'string',
            'password' => 'string',
            'role' => 'string|in:guest,manager,admin',
        ]);

        if ($validator->fails()) {
            $this->printValidationError($validator);

            return;
        }

        $email = $this->argument('email');
        $name = $this->argument('name');
        $password = $this->argument('password');
        $role = $this->argument('role');

        $this->userService->create(
            new UserRegistrationData(
                $email,
                $name,
                $password,
                UserRole::tryFrom($role)
            )
        );

        $this->info('User created successfully!');
    }
}
