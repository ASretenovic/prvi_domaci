<?php

include("../database/constants.php");

if(!isset($_SESSION["id"])){
    header("location: ../index.php");
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
    <script src = "../js/order.js"></script>
    

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
        padding: 2%;
      }

      .card{
        background-color: #FFC06E;
        text-align:center;
        padding: 2%;
      }


      .card-body{
        width:100%;
      }

      #order_form,#add{
        background-color: #01A66F;
      }

    </style>

</head>


<body>

    <div class="overlay"><div class="loader"></div></div>


    <!-- Header -->
    <nav class="navbar" >
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
        <div class="row" >
            <div class="col-md-10">
                <div class="card" style="box-shadow: 0 0 15px;">
                    <div class="card-header">
                        <h3>Nova porudžbina</h3>
                    </div>
                    <div class="card-body">
                        <form id="get_order"  onsubmit="return false">
                            <div class="form-group row">
                                <label  class="col-sm-3" align="right">Datum porudžbine</label>
                                <div class="col-sm-6">
                                    <input type="text" id="order_date" name="order_date" readonly class="form-control form-control-sm" value="<?php echo date("Y-m-d"); ?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label  class="col-sm-3" align="right">Zaposleni*</label>
                                <div class="col-sm-6">
                                    <input type="text" id="employee_name" name="employee_name" class="form-control form-control-sm" placeholder="Unesite ime" required>
                                </div>
                            </div>

                            <div class="card" style="background-color: beige; box-shadow: 0 0 6px; " >
                                <div class="card-body">
                                    <h4>Unesite stavke porudžbine</h4>
                                    <table align="center" style="width:800px;">
                                        <thead>
                                            
                                            <tr>
                                                <th>#</th>
                                                <td style="text-align:center;">Stavka</td>
                                                <td style="text-align:center;">Na stanju</td>
                                                <td style="text-align:center;">Količina</td>
                                                <td style="text-align:center;">Cena</td>
                                                <td></td>
                                                <th>Total</th>
                                            </tr>
                                            
                                        </thead>
                                        <tbody id="invoice_item" style="text-align:center;">
                                        <!--
                                            <tr>
                                                <td><b id="number">1</b></td>
                                                <td>
                                                    <select name="pid[]" id="form-control form-control-sm" required>
                                                        <option>Washing machine</option>
                                                    </select>
                                                </td>
                                                <td><input type="text" name="tqty[]" class="form-control form-control-sm" readonly></td>
                                                <td><input type="text" name="qty[]" class="form-control form-control-sm" required></td>
                                                <td><input type="text" name="price[]" class="form-control form-control-sm" readonly ></td>
                                                <td>3003</td>
                                            </tr>
                                        -->

                                        </tbody>
                                    </table>
                                    <center style="margin: 20px 10px">
                                        <button id = "add" class="btn btn-success" style="width:150px;">Dodaj</button>
                                        <button id = "remove" class="btn btn-danger" style="width:150px;">Izbriši</button>
                                    </center>
                                </div>
                            </div>    
                            <!--  Zavrsava se Stavke porudzbine -->

                            <p></p>
                            <div class="form-group row">
                                <label for="sub_total" class="col-sm-3" align="right">Ukupno</label>
                                <div class="col-sm-6">
                                    <input type="text" name="sub_total" class="form-control form-control-sm" id="sub_total" readonly>
                                </div>
                            </div>

                            <p></p>
                            <div class="form-group row">
                                <label class="col-sm-3" align="right">PDV (20%)</label>
                                <div class="col-sm-6">
                                    <input type="text" name="pdv" class="form-control form-control-sm" id="pdv" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="net_total" class="col-sm-3" align="right">Ukupno za plaćanje</label>
                                <div class="col-sm-6">
                                    <input type="text" name="net_total" class="form-control form-control-sm" id="net_total" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="payment-type" class="col-sm-3" align="right">Način plaćanja</label>
                                <div class="col-sm-6">
                                    <select name="payment_type" id="payment_type" class="form-control form-control-sm">
                                        <option>Keš</option>
                                        <option>Kartica</option>
                                        <option>Ček</option>
                                    </select>
                                </div>
                            </div>

                            <center>
                                <input type="submit" id="order_form" style="width:150px;" class="btn btn-info" value="Poruči">
                            </center>



                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>


</html>