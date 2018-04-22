<?php 

    include "form.html";

    if(isset($_GET["hrstr"]))
        echo strReplace($_GET["hrstr"]);

    function strReplace(string $str)
    {
        $result = heloReplacer($str);
        $response="";
        foreach($result as $value)
            $response=$response.$value;
        return "<div class=\"notice valid\"><b>Source:</b> $str <b>Changed:</b> ".$response.", number of replaced  <b>".$result->getReturn()."<b></div>";
    }

    function heloReplacer(string $str)
    {
        $count = 0;
        for($i=0; $i<strlen($str);$i++)
        {
            switch($str[$i])
            {
                case "o": 
                    yield "php_lab42";
                    $count++;
                break;
                case "l": 
                    yield "1";
                    $count++;
                break;
                case "e": 
                    yield "3";
                    $count++;
                break;
                case "h": 
                    yield "4";
                    $count++;
                break;
                default: 
                    yield $str[$i];
                break;
            }
        }
        return $count;
    }

?>