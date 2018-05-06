<?php 
    include "Generator.php";

$strings = explode("\n", $_POST["strsToJSON"]);
    $sum = 0;
    $data = [];
    $sentences = [];
    $weights = [];
    $probabilities = [];

    function PrepareStrings(&$sentences, &$weights, &$sum, $strings){
        foreach ($strings as  $key => $value) {
            $words = explode(" ", $value);
            $sentences[] = array_slice($words, 0, -1);
            $weight = trim(end($words));
            $sum += $weight;
            $weights[] = $weight;
        }

    }

    function GenerateData(&$probabilities, &$data, &$weights, &$sentences, &$sum){
        for($i = 0; $i < count($weights); $i++)
        {
            $probabilities[] = $weights[$i]/$sum;
            $data[] = [ 
                "text" => implode(" ", $sentences[$i]), 
                "weight" => $weights[$i], 
                "probability" =>  $probabilities[$i]
            ];
        }
    }
    
    function GetPreparedArray(&$probabilities, &$data, &$sentences, &$weights, &$sum, &$strings)
    {
        PrepareStrings($sentences, $weights, $sum, $strings);
        GenerateData($probabilities, $data, $weights, $sentences, $sum);
        return array("sum" => $sum,"data" => $data);
    }

    $resultJSON = json_encode(GetPreparedArray($probabilities, $data, $sentences, $weights, $sum, $strings), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    echo "<pre>".$resultJSON."<br><br>".CheckStringsGenerator($sentences, $probabilities, 10000)."</pre>";
?>