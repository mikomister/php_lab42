<?php
/**
 * Created by PhpStorm.
 * User: Michael Konkov
 * Date: 06.05.18
 * Time: 19:13
 */

session_start();

if (!isset($_SESSION["task11"])) {
    $_SESSION["task11"] = $_POST["strsToJSON"];
}

//var_dump($_REQUEST);
function copyHeaders(): string
{
    $resultHeaders = "";
    foreach (getallheaders() as $key => $value) {
//        if($key == Content-Length)
        $resultHeaders .= "$key: $value\r\n";
    }
    return $resultHeaders;
}

//echo  "<pre>";
//print_r(copyHeaders());

$context_options = array(
    'http' => array(
        'method' => 'POST',
        'header' => copyHeaders(),
        'content' => $_POST["strsToJSON"],
    )
);
//, stream_context_create($context_options)
echo file_get_contents("http://127.0.0.1:5000/hw4/Task4.php", false, stream_context_create($context_options));