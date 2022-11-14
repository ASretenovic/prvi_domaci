<?php

include_once("../database/constants.php");
include_once("user.php");


// ------------------ Login
if(isset($_POST["log_email"]) AND isset($_POST["log_password"])){
    $user = new User();
    $result = $user->userLogin($_POST["log_email"],$_POST["log_password"]);
    echo $result;
    exit();
}

?>