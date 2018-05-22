<?php
/**
 * Created by PhpStorm.
 * User: Michael Konkov
 * Date: 22.05.18
 * Time: 0:00
 */

namespace Logger;

use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

require_once __DIR__ . "/../Psr/Log/LoggerInterface.php";
require_once __DIR__ . "/../Psr/Log/LogLevel.php";
require_once __DIR__ . "/./LogObject.php";

/**
 * Class JsonLogger - implements LoggerInterface to comply with the PSR 3 standard
 *
 * @package Logger
 */
class JsonLogger implements LoggerInterface
{
    private $logFile;

    /**
     * JsonLogger constructor.
     *
     * @param string $logFile
     */
    public function __construct(string $logFile)
    {
        $createdTime = date("j-M-Y");
        $this->logFile = $logFile . "_" . $createdTime . ".txt";
        file_put_contents($this->logFile, "[\n");
    }

    /**
     * System is unusable.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function emergency($message, array $context = [])
    {
        $this->log(LogLevel::EMERGENCY, $message, $context);
    }

    /**
     * Action must be taken immediately.
     *
     * Example: Entire website down, database unavailable, etc. This should
     * trigger the SMS alerts and wake you up.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function alert($message, array $context = [])
    {
        $this->log(LogLevel::ALERT, $message, $context);
    }

    /**
     * Critical conditions.
     *
     * Example: Application component unavailable, unexpected exception.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function critical($message, array $context = [])
    {
        $this->log(LogLevel::CRITICAL, $message, $context);
    }

    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function error($message, array $context = [])
    {
        $this->log(LogLevel::ERROR, $message, $context);
    }

    /**
     * Exceptional occurrences that are not errors.
     *
     * Example: Use of deprecated APIs, poor use of an API, undesirable things
     * that are not necessarily wrong.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function warning($message, array $context = [])
    {
        $this->log(LogLevel::WARNING, $message, $context);
    }

    /**
     * Normal but significant events.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function notice($message, array $context = [])
    {
        $this->log(LogLevel::NOTICE, $message, $context);
    }

    /**
     * Interesting events.
     *
     * Example: User logs in, SQL logs.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function info($message, array $context = [])
    {
        $this->log(LogLevel::INFO, $message, $context);
    }

    /**
     * Detailed debug information.
     *
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function debug($message, array $context = [])
    {
        $this->log(LogLevel::DEBUG, $message, $context);
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     *
     * @return void
     */
    public function log($logLevel, $message, array $context = [])
    {
        if (count($context) > 0) {
            $message = $this->interpolate($message, $context);
        }
        $logObj = json_encode(new LogObject($logLevel, $message)) . ",\n";
        file_put_contents($this->logFile, $logObj, FILE_APPEND);
    }

    /**
     * @param $message
     * @param array $context
     * @return mixed
     */
    private function interpolate($message, array $context = [])
    {
        foreach ($context as $key) {
            $context["{" . $key . "}"] = $context[$key];
            unset($context[$key]);
        }
        return strtr($message, $context);
    }

    public function __destruct()
    {
        $result = substr(file_get_contents($this->logFile), 0, -2);
        file_put_contents($this->logFile, $result . "\n]");
    }
}