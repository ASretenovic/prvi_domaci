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


/* TO GET CATEGORY */
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


?>