<?php

    $strings = explode("\n", $_POST["strsToSort"]);
    $shuffledStrings = array();
    $t = true;

    for($i=0; $i < count($strings); $i++)
    {
        $words = explode(" ", $strings[$i]);
        if(count($words) < 2){
            echo "Words in $i sentence < 2!";
            $t = false;
            break;
        }
        shuffle($words);
        $shuffledStrings[] = implode(" ", $words);
    }

    if($t)
    {
        $result = array_merge($strings, $shuffledStrings);
        usort($result, "StringsBySecondWordComparator");
        ShowArray($result);
    }

    function ShowArray($arr){
        foreach ($arr as $value)
            echo $value."<br>";
    }

    function StringsBySecondWordComparator(string $str1, string $str2)
    {
        return explode(" ", $str1)[1] <=> explode(" ", $str2)[1];
    }

?>