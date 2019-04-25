<?php

namespace App\Repositories\Exceptions;

use Exception;

class NoEntityDefined extends Exception
{
    protected $message = "There is no entity() method defined.";
}