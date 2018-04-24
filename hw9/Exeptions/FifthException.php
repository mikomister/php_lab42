<?php
/**
 * Created by PhpStorm.
 * User: Michael Konkov
 * Date: 23.04.18
 * Time: 21:39
 */

namespace Exeptions;


class FifthException extends FourthException
{
    public function __construct(string $message = "Fifth exception", int $code = 5)
    {
        parent::__construct($message, $code);
    }
}