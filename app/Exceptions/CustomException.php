<?php

namespace App\Exceptions;

use Exception;

class CustomException extends Exception
{
    protected $message = 'Somerthing whent wrong';

    protected $type = 'error';

    public function __construct()
    {

    }

    public function render()
    {
        $message = ['message' => $this->message, 'messageType' => $this->type];
        return redirect()->route('home')->with($message);
    }

    public function withType($type)
    {
        $this->type = $type;
        return $this;
    }

    public function withMessage($message)
    {
        $this->message = $message;
        return $this;
    }
}
