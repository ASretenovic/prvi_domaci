<?php

    include("./database/constants.php");
    if(isset($_SESSION["id"])){
        session_destroy();
    }

    header("location: ./index.php");   

?>