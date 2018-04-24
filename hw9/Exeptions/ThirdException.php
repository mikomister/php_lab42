<?php
/**
 * Created by PhpStorm.
 * User: Michael Konkov
 * Date: 23.04.18
 * Time: 21:33
 */

namespace Exeptions;


class ThirdException extends SecondException
{
    public function __construct(string $message = "Third exception", int $code = 3)
    {
        parent::__construct($message, $code);
    }

    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}