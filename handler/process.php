<?php

include_once("../database/constants.php");
include_once("user.php");
include_once("DBOperations.php");
include_once("manage.php");


// ------------------ Login
if(isset($_POST["log_email"]) AND isset($_POST["log_password"])){
    $user = new User();
    $result = $user->userLogin($_POST["log_email"],$_POST["log_password"]);
    echo $result;
    exit();
}


// -------------------------------------------- Kategorija ----------------------------------------------------

// Dodaj kategoriju
if(isset($_POST["category_name"])){
    $obj = new DBOperations();
    $result = $obj->addCategory($_POST["category_name"]);
    echo $result;
    exit();
}


// Tabelarni prikaz svih kategorija
if(isset($_POST["manageCategory"])){
    $m = new Manage();
    $result = $m->manageRecord("kategorija");
    $rows = $result;

    if(count($rows) > 0){
        foreach($rows as $row){
            ?>
                <tr>
                    <td><?php echo $row["kid"] ?></td>
                    <td><?php echo $row["naziv_kategorije"]; ?></td>
                    <td><a href="#" class="btn btn-success btn-sm">Aktivan</a></td>
                    <td>
                        <a href="#" did = "<?php echo $row["kid"]; ?>" class="btn btn-danger btn-sm del_cat">Izbriši</a>
                        <a href="#" eid = "<?php echo $row["kid"]; ?>" data-toggle="modal" data-target="#form_category" class="btn btn-info btn-sm edit_cat">Izmeni</a>
                    </td>
                </tr>
            <?php
        }
    }
}


// Ucitavanje svih kategorija u padajucu listu
if(isset($_POST["getCategory"])){
    $obj = new DBOperations();
    $rows = $obj->getAllRecord("kategorija");
    foreach($rows as $row){
        echo "<option value='".$row["kid"]."'>".$row["naziv_kategorije"]."</option>";    
    }                                                                               
    exit();
}



// Izmena kategorije - selekcija reda u kom se vrse izmene
if(isset($_POST["updateCategory"])){
    $m = new Manage();
    $result = $m->getSingleRecord("kategorija",$_POST["cid"]);
    echo json_encode($result);
    exit();
}


// Izmena kategorije - postavljanje nove vrednosti
if(isset($_POST["update_category"])){
    $m = new Manage();
    $cid = $_POST["cid"];
    $name = $_POST["update_category"];
    $result = $m->update_record("kategorija",["kid"=>$cid],["naziv_kategorije"=>$name]);
    echo $result;
    exit();
}


// Brisanje kategorije
if(isset($_POST["deleteCategory"])){
    $m = new Manage();
    $result = $m->deleteRecord("kategorija",$_POST["cid"]);
    echo $result;
    exit();
}



// ----------------------------------------------- Proizvod -------------------------------------------------------

// Dodaj proizvod
if(isset($_POST["product_name"])){
    $obj = new DBOperations();
    $result = $obj->addProduct($_POST["select_cat"],$_POST["product_name"],$_POST["product_price"],$_POST["product_stock"]);
    echo $result;
    exit();
}


// Tabelarni prikaz svih proizvoda                    
if(isset($_POST["manageProducts"])){
    $m = new Manage();
    $result = $m->manageRecord("proizvod");
    $rows = $result;

    if(count($rows) > 0){
        foreach($rows as $row){
            ?>
                <tr>
                    <td><?php echo $row["pid"] ?></td>
                    <td><?php echo $row["naziv_proizvoda"]; ?></td>
                    <td><?php echo $m->getCategoryName($row["kid"]); ?></td>
                    <td><?php echo $row["cena_proizvoda"]; ?></td>
                    <td><?php echo $row["kolicina"]; ?></td>
                    <td>
                        <a href="#" did = "<?php echo $row["pid"]; ?>" class="btn btn-danger btn-sm del_product">Izbriši</a>
                        <a href="#" eid = "<?php echo $row["pid"]; ?>" data-toggle="modal" data-target="#form_products" class="btn btn-info btn-sm edit_product">Izmeni</a>
                    </td>
                </tr>
            <?php
        }
    }
}


// Izmena proizvoda - selekcija reda u kom se vrse izmene
if(isset($_POST["updateProduct"])){
    $m = new Manage();
    $result = $m->getSingleRecord("proizvod",$_POST["pid"]);
    echo json_encode($result);
    exit();
}


// Izmena proizvoda - cuvanje promena
if(isset($_POST["update_product"])){
    $m = new Manage();
    $pid = $_POST["pid"];
    $cat = $_POST["select_cat"];
    $name = $_POST["update_product"];
    $price = $_POST["product_price"];
    $stock = $_POST["product_stock"];
    $result = $m->update_record("proizvod",["pid"=>$pid],["naziv_proizvoda"=>$name,"kid"=>$cat,"cena_proizvoda"=>$price,"kolicina"=>$stock]);
    echo $result;
    exit();
}


// Brisanje proizvoda
if(isset($_POST["deleteProduct"])){
    $m = new Manage();
    $result = $m->deleteRecord("proizvod",$_POST["pid"]);
    echo $result;
    exit();
}




?>