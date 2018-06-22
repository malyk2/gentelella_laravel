<?php

namespace App\Exceptions;

use Exception;

class PermissionException extends Exception
{
    public function __construct($message = null, $code = null)
    {

    }

    public function render()
    {
        return redirect()->back()->pnotify('Доступ заборонено', '','error');
    }
}
