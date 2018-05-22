<?php
/**
 * Created by PhpStorm.
 * User: Michael Konkov
 * Date: 22.05.18
 * Time: 0:04
 */

namespace Logger;

/**
 * Class LogObject - describes the single record data model for logging
 * @package Logger
 */
class LogObject
{
    public $logLevel;
    public $time;
    public $message;

    /**
     * LogObject constructor.
     * @param $logLevel - level of message to logging
     * @param $message - message to logging
     * @param $time - time
     */
    public function __construct($logLevel, $message)
    {
        $this->logLevel = $logLevel;
        $this->message = $message;
        $this->time = date("j-M-Y_H:i:s");
    }

}