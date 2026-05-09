<?php

namespace App\Console\Commands\User;

use App\Console\Commands\AbstractCommand;
use App\Contracts\UserServiceInterface;
use Illuminate\Console\Command;

class ListUsersCommand extends AbstractCommand
{
    protected $signature = 'user:list';

    protected $description = 'List users';

    public function __construct(private UserServiceInterface $userService)
    {
        parent::__construct();
    }

    public function handle(): void
    {
        $rows = [];

        $users = $this->userService->list();

        foreach ($users as $user) {
            $rows[] = [
                $user->id,
                $user->name,
                $user->email,
                $user->getRole()->label(),
            ];
        }

        $this->table(
            [
                'ID', 'Name', 'Email', 'Role'
            ],
            $rows
        );
    }
}
