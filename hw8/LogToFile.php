<?php
/**
 * Created by PhpStorm.
 * User: Michael Konkov
 * Date: 23.04.18
 * Time: 0:53
 */

require_once 'Logger.php';

class LogToFile extends Logger
{
    private $filename;

    function __construct($filename = "Logs.txt")
    {
        $this->filename = $filename;
    }

    public function Log(string $str)
    {
        file_put_contents($this->filename, $str, FILE_APPEND);
    }

    function __destruct()
    {
        // TODO: No necessary to close file, because i use file_put_contents method, that automatically closed file after write;
    }
}