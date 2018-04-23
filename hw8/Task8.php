<?php
/**
 * Created by PhpStorm.
 * User: Michael Konkov
 * Date: 23.04.18
 * Time: 13:31
 */

require_once "LogToBrowser.php";
require_once "LogToFile.php";

$logger = $_POST["logger"];
$strings = explode("\n", $_POST["textToLog"]);

if ($logger == "toBrowser") {
    $logger = (isset($_POST["timeFormat"])) ? new LogToBrowser($_POST["timeFormat"]) : new LogToBrowser();
} else {
    $logger = empty($_POST["filename"]) ? new LogToFile() : new LogToFile($_POST["filename"]);
}

function checkStringsForUpperSymbols($strings, $logger)
{
    for ($i = 0; $i < count($strings); $i++) {
        if (preg_match('/[[:upper:]]|[А-Я]/s', $strings[$i]))
            $logger->log("Строка #$i: содержит заглавные буквы.\n");
        else  $logger->log("Строка #$i: не содержит заглавные буквы.\n");
    }
}

checkStringsForUpperSymbols($strings, $logger);