<?php

include("../database/constants.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <script src = "../js/main.js"></script>
    <script src = "../js/manage.js"></script>
    

    
    <style>
        body{
        background-color: #75CE9F;
      }

      .navbar{
        background-color: #01A66F;
      }

      .navbar-brand{
        color:#F3E0DC;
      }

      .nav-link{
        color:#F3E0DC; 
        padding-left:50px;
      }

      .container{
        padding: 5%;
      }

      #table_category{
        background-color: #BDD99E;
      }

    </style>

</head>

<body>

<nav class="navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><i class="fa fa-leaf"></i>Gardening world</a>
            <br>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup"> 
                <div class="navbar-nav">
                    <a class="nav-link active" aria-current="page" href="../pocetna.php"><i class="fa fa-home"></i>Početna</a>
                   

                    <?php
                        if(isset($_SESSION["id"])){
                    ?>
                        <a class="nav-link active" aria-current="page"href="../logout.php"><i class="fa fa-user"></i>Odjavi se</a>
                    <?php
                        }
                    ?>

                    
                </div>
            </div>
        </div>
    </nav>



<div class="container">
    <div class="form-group">
        <div class="input-group">
            <div class="input-group-addon">
            <label>Pretražite proizvode:</label>
            <br>
                <input type="text" name="search_text" id="search_text" class="form-control">
            </div>
        </div>
    </div>
    <div id="result"></div>
</div>
    

</body>
</html>