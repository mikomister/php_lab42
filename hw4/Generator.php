<?php
// Maybe some floor(mt_rand(0, count($sentences)-1)+$probabilities[floor(mt_rand(0,1))]);
    function GenerateStrings($sentences, $probabilities, int $amount){
         for($i=0; $i<count($sentences); $i++) {
             for($j=0; $j < (($i%2 == 1) ?  floor($amount*$probabilities[$i]):ceil($amount*$probabilities[$i])); $j++)
                 yield implode(" ", $sentences[$i]);
         }
    }

    function CheckStringsGenerator(&$sentences, &$probabilities, int $amount)
    {
        $generatedStrings = [];
        foreach (GenerateStrings($sentences, $probabilities, $amount) as $value) {
            if(!isset($generatedStrings[$value]))
                $generatedStrings[$value] = 0;
            $generatedStrings[$value]++;
        }
        $toJSON = [];
        foreach ($generatedStrings as $key => $value) {
            $toJSON[] = [
                "text" => $key,
                "count" => $value,
                "calculated_probability" => $value / $amount
            ];
        }
        return json_encode($toJSON, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }

?>