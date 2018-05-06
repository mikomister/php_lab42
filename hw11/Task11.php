<?php
/**
 * Created by PhpStorm.
 * User: Michael Konkov
 * Date: 06.05.18
 * Time: 17:17
 */

session_save_path(__DIR__ . "/sessions");
session_name("task11_SID");
session_set_cookie_params(60);
session_start();

include "form.php";


//echo file_get_contents("http://php.net");
