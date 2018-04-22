<?php
    $code = str_split($_POST['code']);
    $params = str_split($_POST['params']);

    $tArr = [0];
    $result="";
    $brackets = 0;
    for($i=0, $cur=0, $pCur=0; $i < count($code); $i++)
    {
        switch ($code[$i]) {
            case '>':
                $cur++;
                if(!isset($tArr[$cur])) 
                    $tArr[$cur] = 0;
                break;

            case '<':
                $cur--;
                break;

            case '+':
                $tArr[$cur]++;
                if($tArr[$cur] > 255) $tArr[$cur] = 0;
                break;

            case '-':
                $tArr[$cur]--;
                if($tArr[$cur] < 0) $tArr[$cur] = 255;
                break;

            case '.':
                $result=$result.chr($tArr[$cur]);
                break;

            case ',':
                $tArr[$cur]=ord($params[$pCur]);
                $pCur++;    
                break;

            case '[':
                if($tArr[$cur] == 0) {
                    $brackets = 1;
                    while($brackets != 0) {
                        $i++;
                        if($code[$i] == "[")
                            $brackets++;
                        else if($code[$i] == "]")
                            $brackets--;
                    }
                }
                break;
            case "]" :
                if($tArr[$cur] != 0) {
                    $brackets = 1;
                    while($brackets != 0) {
                        $i--;
                        if($code[$i] == "]")
                            $brackets++;
                        else if($code[$i] == "[")
                            $brackets--;
                    }
                }
                break;
            default:
                break;
        }
    }
    echo "<div class=\"notice valid\">$result</div>";
?>