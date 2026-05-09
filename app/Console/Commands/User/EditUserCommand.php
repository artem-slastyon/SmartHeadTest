<?php

namespace App\Console\Commands\User;

use App\Console\Commands\AbstractCommand;
use App\Contracts\UserServiceInterface;
use App\Enums\UserRole;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class EditUserCommand extends AbstractCommand
{
    protected $signature = 'user:edit {id} {--role=} {--password=}';

    protected $description = 'Edit user';

    public function __construct(private UserServiceInterface $userService)
    {
        parent::__construct();
    }


    public function handle(): void
    {
        $validator = Validator::make(
            array_merge(
                $this->arguments(),
                $this->options()
            ),
            [
                'id' => 'int|required',
                'role' => 'string|in:guest,manager,admin|nullable',
                'password' => 'string|nullable'
            ]
        );

        if ($validator->fails()) {
            $this->printValidationError($validator);
            return;
        }

        $id = $this->argument('id');
        $role = UserRole::tryFrom($this->option('role'));
        $password = $this->option('password');

        if ($role) {
            $this->userService->updateRole($id, $role);
        }

        if ($password) {
            $this->userService->updatePassword($id, $password);
        }

        $this->info('User updated successfully!');
    }
}
