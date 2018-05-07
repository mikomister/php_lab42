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

//echo $_POST["strsToJSON"];

function copyHeaders(): string
{
    $resultHeaders = "";
    foreach (getallheaders() as $key => $value) {
        $resultHeaders .= "$key: $value\r\n";
    }
    return $resultHeaders;
}

function get_web_page($url)
{
    $options = array(
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POST => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HEADER => copyHeaders(),
        CURLOPT_POSTFIELDS => http_build_query(array("strsToJSON" => $_POST["strsToJSON"])),
        CURLOPT_ENCODING => "UTF-8",
    );

    $ch = curl_init($url);
    curl_setopt_array($ch, $options);
    $content = curl_exec($ch);
    $err = curl_errno($ch);
    $errmsg = curl_error($ch);
    $header = curl_getinfo($ch);
    curl_close($ch);

    $header['errno'] = $err;
    $header['errmsg'] = $errmsg;
    $header['content'] = $content;
    return $header;
}

$cl = strlen($_POST["strsToJSON"]);
$context_options = array(
    'http' => array(
        'method' => 'POST',
        'header' => 'Content-type: application/x-www-form-urlencoded',
        'content' => http_build_query(array("strsToJSON" => $_POST["strsToJSON"])),
    )
);

//$context_options = array(
//    'http' => array(
//        'method' => 'POST',
//        'header' => copyHeaders(),
//        'content' => array ("strsToJSON"=>$_POST["strsToJSON"]),
//    )
//);
//
$context = stream_context_create($context_options);
echo(file_get_contents("http://localhost:8080/hw4/Task4.php", false, $context));

// echo get_web_page("http://localhost:8080/hw4/Task4.php")["content"];