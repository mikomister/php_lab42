<?php
function GenerateStrings($sentences, $sum, $weights)
{

    while (true) {
        $rnd = random_int(1, $sum);
        while ($rnd > 0) {
            for ($j = 0; $j < count($sentences) && $rnd > 0; $j++)
                $rnd -= $weights[$j];
        }
        yield implode(" ", $sentences[$j - 1]);
    }
}

function CheckStringsGenerator($sentences, int $sum, int $amount, $weights)
{
    $generatedStrings = [];
    $k = $amount;
    foreach (GenerateStrings($sentences, $sum, $weights) as $value) {
        if ($k < 1) break;
        if (!isset($generatedStrings[$value]))
            $generatedStrings[$value] = 0;
        $generatedStrings[$value]++;
        $k--;
    }
    $toJSON = [];
    foreach ($generatedStrings as $key => $value) {
        $toJSON[] = [
            "text" => $key,
            "count" => $value,
            "calculated_probability" => $value / $amount,
        ];
    }
    return json_encode($toJSON, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
}

?>