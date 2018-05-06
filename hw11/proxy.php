<?php
/**
 * Created by PhpStorm.
 * User: Michael Konkov
 * Date: 06.05.18
 * Time: 19:13
 */
session_save_path(__DIR__ . "/sessions");
session_name("task11_SID");
session_set_cookie_params(60);
session_start();

if (!isset($_SESSION["task11"])) {
    $_SESSION["task11"] = $_POST["strsToJSON"];
}

//function copyHeaders(): string
//{
//    $resultHeaders = "";
//    foreach (getallheaders() as $key => $value) {
////        if($key == Content-Length)
//        $resultHeaders .= "$key: $value\r\n";
//    }
//    return $resultHeaders;
//}

//echo  "<pre>";
//print_r(copyHeaders());

$cl = strlen($_POST["strsToJSON"]);
$context_options = array(
    'http' => array(
        'method' => 'POST',
        'header' => 'Content-type: application/x-www-form-urlencoded' . "Content-Length: $cl",
        'content' => $_POST["strsToJSON"],
    )
);
//, stream_context_create($context_options)
$context = stream_context_create($context_options);
echo file_get_contents("http://localhost:4000", false, $context);