<?php
/**
 * Created by PhpStorm.
 * User: Michael Konkov
 * Date: 23.04.18
 * Time: 21:36
 */

namespace Exceptions;


class FourthException extends ThirdException
{
    public function __construct(string $message = "Fourth exception", int $code = 4)
    {
        parent::__construct($message, $code);
    }

}