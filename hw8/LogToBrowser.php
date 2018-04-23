<?php
/**
 * Created by PhpStorm.
 * User: Michael Konkov
 * Date: 23.04.18
 * Time: 0:55
 */

require_once "Logger.php";

class LogToBrowser extends Logger
{
    private $timeFormats = [
        0 => 'H:i:s',
        1 => 'j.m.Y H:i:s'
    ];

    private $timeFlag;

    function __construct($timeFlag = null)
    {
        $this->timeFlag = $timeFlag;
    }

    public function Log(string $str)
    {
        if (is_null($this->timeFlag) || !array_key_exists($this->timeFlag, $this->timeFormats))
            echo "LOG: $str <br>";
        else
            echo "LOG[" . date($this->timeFormats[$this->timeFlag]) . "]: $str <br>";
    }
}
