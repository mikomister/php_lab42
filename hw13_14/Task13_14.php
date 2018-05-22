<?php
/**
 * Created by PhpStorm.
 * User: Michael Konkov
 * Date: 21.05.18
 * Time: 23:59
 */

use Logger\JsonLogger;

require_once "./Logger/JsonLogger.php";

$filename = "Logs";

$testLogger = new JsonLogger($filename);

$testLogger->log("Test Log", "Success!");
$testLogger->info("Information!");
$testLogger->warning("Warning!");
$testLogger->error("Error!");
$testLogger->critical("Critical Error {code}", ["code" => 555]);

unset($testLogger);

echo "<pre>" . file_get_contents($filename) . "</pre>";

echo "<br><a href='Documentation/index.html'>Look at the Documentation</a>";