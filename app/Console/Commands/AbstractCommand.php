<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Validation\Validator;

abstract class AbstractCommand extends Command
{
    protected function printValidationError(Validator $validator): void
    {
        $this->info('Validation failed:');

        foreach ($validator->errors()->all() as $error) {
            $this->error($error);
        }
    }
}
