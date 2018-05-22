<?php
/**
 * Created by PhpStorm.
 * User: Michael Konkov
 * Date: 21.05.18
 * Time: 23:59
 */

use Logger\JsonLogger;

require_once "./Logger/JsonLogger.php";

$testLogger = new JsonLogger("Logs");

$testLogger->log("Test Log", "Success!");
$testLogger->info("Information!");
$testLogger->warning("Warning!");
$testLogger->error("Error!");
$testLogger->critical("Critical Error {code}", ["code" => -1]);

unset($testLogger);