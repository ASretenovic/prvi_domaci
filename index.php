<?php

    include("./database/constants.php");
    if(isset($_SESSION["id"])){
        header("location: ./pocetna.php");          
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
        background-color: #FFC06E;
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
        margin-top: 5%;
      }


      #card-login-div{
        background-color: #01A66F; 
        padding: 2% 28%; 
        box-shadow:0px 0px 15px 7px #01A66F;
      }

      #login-card{
        width: 30vw; 
        background-color: #FFC06E; 
        padding-bottom:50px;
      }

      img{
        width:80%; 
        padding: 1% 10% 1% 5%;
      }

      .card{
        padding: 2%;
      }

      #dugme{
        width:100%; 
        background-color: #01A66F;
      }
    </style>

</head>



<body>

<!-- Header -->
    <nav class="navbar" >
        <div class="container-fluid">
            <a class="navbar-brand" href="#" ><i class="fa fa-leaf"></i>Gardening World</a>
            <br>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup"> 
                <div class="navbar-nav">
                    <a class="nav-link active" aria-current="page" href="index.php" ><i class="fa fa-home"></i>Početna</a>       
                </div>
            </div>
        </div>
    </nav>


    <div class="container" id="card-login-div">

        <div id="login-card" class="card">
            <img src="./images/login.png" class="card-img-top" alt="Login icon">
            <div class="card-body">

                <form id = "form_log" onsubmit = "return false">
                    <div class="form-outline mb-4">
                        <label class="form-label">Email adresa</label>
                        <input type="email" id = "log_email" name="log_email" class="form-control" required />
                        <small id="email_error" class="form-text text-muted"></small>
                    </div>

                    <div class="form-outline mb-4">
                        <label class="form-label">Lozinka</label>
                        <input type="password" id="log_password" name = "log_password" class="form-control" required/>
                        <small id="password_error" class="form-text text-muted"></small>
                    </div>
                    <br>

                    <button id = "dugme" type="sumbit" class="btn btn-primary btn-block mb-4">Prijavi se</button>
                </form>

            </div>
        </div>
    </div>


</body>
</html>