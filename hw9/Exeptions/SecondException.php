<?php
/**
 * Created by PhpStorm.
 * User: Michael Konkov
 * Date: 23.04.18
 * Time: 21:31
 */

namespace Exeptions;


class SecondException extends FirstException
{
    public function __construct(string $message = "Second exception", int $code = 2)
    {
        parent::__construct($message, $code);
    }
}