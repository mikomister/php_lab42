<?php

$ping = isset($_POST["ping"]);
$tracert = isset($_POST["tracert"]);
$url = $_POST["URL"];
echo "<pre>";
if (ValidateURL($url)) {
    $url = escapeshellcmd($url);
    if ($ping) Ping($url);
    if ($tracert) TraceRouter($url);
} else {
    echo "<b>Invalid URL, enter a valid URL!</b>";
}

echo "</pre>";

function ValidateURL($url)
{
    return preg_match('#^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$#s', $url);
}


function RunCMD($cmd)
{
    $descriptorspec = [
        0 => ["pipe", "r"],
        1 => ["pipe", "w"],
        2 => ["pipe", "w"]
    ];

    $process = proc_open($cmd, $descriptorspec, $pipes);
    if (is_resource($process)) {
        $result = stream_get_contents($pipes[1]);
        fclose($pipes[1]);

        $error = stream_get_contents($pipes[2]);
        fclose($pipes[2]);
        proc_close($process);
        if(empty($error))
            return $result;
        else return $error;
    }
}

function Ping($url)
{
    $pingPattern = '#(?<ip>([0-9]{1,3}[\.]){3}[0-9]{1,3}).*\s(?<percents>([0-9]+))%.*#i';
    $pingResult=RunCMD("ping $url -c 4");
    $pr = [];
    preg_match($pingPattern, preg_replace('#\\n#i', " ", $pingResult), $pr);
    echo "<b>--- $url ping statistics ---</b><br><br>";
    if(!isset($pr["ip"]) && !isset($pr["percents"]) ) echo $pingResult."<br>";
    else
    {
        echo ("<b>".$pr["ip"]."</b> Successfully received ".(100-$pr["percents"])."% of packages.<br>");
    }
}

function TraceRouter($url)
{
    $tracePattern = '#\s[(](([0-9]{1,3}[\.]){3}[0-9]{1,3})[)]\s#i';
    $traceResult = RunCMD("traceroute $url -w 1.25");
    echo "<br><b>--- traceroute to $url ---</b><br><br>";
    $tr = [];
    $temp = explode("\n", $traceResult);
    foreach ($temp as $item) {
        $tempArr =[];
        if(preg_match($tracePattern, $item, $tempArr))
            $tr[] = $tempArr[1];
    }
    $TRcount = count($tr);
    if( $TRcount == 0) echo $traceResult;
    else
    {
        for($i=0; $i < $TRcount-1; $i++) {
            echo "{$tr[$i]} -> ";
        }
        echo $tr[$TRcount-1];
    }
}

?>