<?php
/**
 * Created by PhpStorm.
 * User: Michael Konkov
 * Date: 22.04.18
 * Time: 20:20
 */

function TranscodeStringsFile(string $pathToINIFile = "Task6.ini")
{
    $settings = parse_ini_file($pathToINIFile, true, INI_SCANNER_TYPED);
    $srcStrings = file($settings["main"]["filename"], FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($srcStrings as $value) {
        if (strpos($value, $settings["first_rule"]["symbol"]) === 0) {
            if ($settings["first_rule"]["upper"] == "true")
                echo strtoupper($value);
            else
                echo strtolower($value);

        } elseif (strpos($value, $settings["second_rule"]["symbol"]) === 0) {
            if ($settings["second_rule"]["direction"] == "+")
                echo ReplaceNumbers($value, 1);
            else
                echo ReplaceNumbers($value, -1);
        } elseif (strpos($value, $settings["third_rule"]["symbol"]) === 0) {
            echo str_replace($settings["third_rule"]["delete"], "", $value);
//            echo str_ireplace($settings["third_rule"]["delete"],"", $value);
        } else
            echo $value;
        echo "<br>";
    }
}

function ReplaceNumbers(string $str, int $increment)
{
    for ($i = 0; $i < strlen($str); $i++) {
        if (ctype_digit($str[$i])) {
            $str[$i] = ($str[$i] + $increment) % 10;
        }
    }
    return $str;
}

TranscodeStringsFile();
?>