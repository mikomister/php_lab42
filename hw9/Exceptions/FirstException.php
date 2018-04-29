<?php
/**
 * Created by PhpStorm.
 * User: Michael Konkov
 * Date: 23.04.18
 * Time: 20:55
 */

namespace Exceptions;

class FirstException extends \Exception
{
    public function __construct(string $message = "First exception", int $code = 1)
    {
        parent::__construct($message, $code);
    }

    public function __toString()
    {
        $temp = explode("\\", get_class($this));
        return "<b>" . end($temp) . " [{$this->code}]:</b> <i>{$this->message}</i><br>";
    }
}