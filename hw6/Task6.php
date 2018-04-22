<?php
/**
 * Created by PhpStorm.
 * User: Michael Konkov
 * Date: 22.04.18
 * Time: 20:20
 */

    function TranscodeStringsFile(string $pathToINIFile="Task6.ini"){
        $settings = parse_ini_file($pathToINIFile, true, INI_SCANNER_TYPED);
        $symbols = [];
        $srcStrings = file($settings["main"]["filename"], FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($srcStrings as $value) {
            if(preg_match('/^'.$settings["first_rule"]["symbol"].'/s', $value))
            {
                //к сожалению я так и не понял почему не сработал модификатор INI_SCANNER_TYPED в parse_ini_file
                if($settings["first_rule"]["upper"]=="true")
                    echo strtoupper($value);
                else
                    echo strtolower($value);

            }
            elseif(preg_match('/^'.$settings["second_rule"]["symbol"].'/s', $value))
            {
                if($settings["second_rule"]["direction"]=="+")
                    echo ReplaceNumbers($value, 1);
                else
                    echo ReplaceNumbers($value, -1);
            }
            elseif (preg_match('/^'.$settings["third_rule"]["symbol"].'/s', $value))
            {
                echo preg_replace('/'.$settings["third_rule"]["delete"].'/s', "", $value);
            }
            else
                echo $value;
            echo "<br>";
        }
    }
    function ReplaceNumbers(string $str,int $increment)
    {
        for($i=0; $i<strlen($str);$i++)
        {
            if(ctype_digit($str[$i]))
            {
                $str[$i] = ($str[$i]+$increment) % 10;
            }
        }
        return $str;
    }
    TranscodeStringsFile();
    // print_r(parse_ini_file("Task6.ini", true, INI_SCANNER_TYPED));

?>