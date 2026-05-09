<?php

namespace App\Exceptions;

use Exception;

class UserException extends Exception
{

    public static function userNotFound(): UserException
    {
        return new self('User not found');
    }
}
