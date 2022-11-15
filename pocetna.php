<?php

    include("./database/constants.php");
    if(!isset($_SESSION["id"])){
        header("location: ./index.php");
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gardening World</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <script src = "./js/main.js"></script>
    

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
        color:white;
        margin-top: 5%;
      }

      .card{
        background-color: #FFC06E;
        text-align:center;
        padding: 2%;
      }

      .jumbotron{
        background-color: #01A66F;
      }

      .button{
        background-color: #01A66F;
      }

    </style>

</head>


<body>

    <!-- Header -->
    <nav class="navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><i class="fa fa-leaf"></i>Gardening world</a>
            <br>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup"> 
                <div class="navbar-nav">
                    <a class="nav-link active" aria-current="page" href="pocetna.php"><i class="fa fa-home"></i>Početna</a>

                    <!-- Odjavi se -->
                    <?php
                        if(isset($_SESSION["id"])){
                    ?>
                    <!-- opcija Odjavi se se pojavljuje samo ako je korisnik prijavljen -->
                        <a class="nav-link active" aria-current="page"href="./logout.php"><i class="fa fa-user"></i>Odjavi se</a>
                    <?php
                        }
                    ?>
                  
                </div>
            </div>
        </div>
    </nav>


    <div class="container" id="dash">
        <div class="row">

            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <img src="./images/user1.png" class="card-img-top" style="width: 100%" alt="User">
                    <div class="card-body">
                        <h5 class="card-title"><b>Podaci o korisniku:</b></h5>
                        <p class="card-text"><?php echo $_SESSION["username"]; ?></p>
                        <p class="card-text">Admin</p>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="jumbotron">
                    <h2>Zdravo <?php echo explode(" ",$_SESSION["username"])[0]; ?>!</h2>
                    <div class="row">
                        <div class="col-sm-6">
                            <iframe src="https://free.timeanddate.com/clock/i8khk3sx/n35/szw110/szh110/cf100/hnce1ead6" frameborder="0" width="110" height="110"></iframe>
                        </div>
                        
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Nove porudžbine</h4>
                                    <p class="card-text">Rad sa porudžbinama.</p>
                                    <a href="./templates/porudzbina.php" class="btn btn-primary button">Poruči</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <p></p>
    <p></p>
    <div class="container">
        <div class="row">

            <div class="col-md-6">
                <div class="card" style="margin: 20px 0px;">
                    <div class="card-body"  style="text-align: center;">
                        <h3 class="card-title">Upravljaj kategorijama.</h3>
                        <p class="card-text">Rad sa kategorijama.</p>
        
                        <a href="#" data-toggle="modal" data-target="#form_category" class="btn btn-primary button">Dodaj</a>
                        <a href="templates/upravljanje_kategorijom.php" class="btn btn-primary button">Izmeni</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card" style="margin: 20px 0px;">
                    <div class="card-body" style="text-align: center;">
                        <h3 class="card-title">Upravljaj proizvodima</h3>
                        <p class="card-text">Rad sa proizvodima.</p>
                        <a href="#" class="btn btn-primary button" data-toggle="modal" data-target="#form_products">Dodaj</a>
                        <a href="templates/pretrazi_proizvode.php" class="btn btn-primary button">Pregledaj i pretraži</a>
                        <a href="templates/upravljanje_proizvodima.php" class="btn btn-primary button">Izmeni</a>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <?php
        include_once("./templates/nova_kategorija.php");
    ?>

    <?php
        include_once("./templates/novi_proizvod.php");
    ?>

</body>
</html>