<?php

include_once("../database/constants.php");
include_once("manage.php");

$connection = mysqli_connect(HOST,USER,PASS,DB);


if(isset($_POST["search"])){
$output = '';
$m = new Manage();

$sql = "SELECT pid,kid,naziv_proizvoda,cena_proizvoda,kolicina FROM proizvod WHERE naziv_proizvoda LIKE '%".$_POST["search"]."%'";
$result = mysqli_query($connection,$sql);
if(mysqli_num_rows($result)>0){
    $output .= '<h4 align="center">Rezultati pretrage</h4>' ;
    $output .= '<div class="table-responsive">
                    <table class="table table bordered">
                        <tr>
                            <th>#</th>
                            <th>Naziv proizvoda</th>
                            <th>Kategorija</th>
                            <th>Cena</th>
                            <th>Količina</th>
                        </tr>';
                        while($row = mysqli_fetch_array($result)){
                            $output .= '
                            <tr>
                                <td>'.$row["pid"].'</td>
                                <td>'.$row["naziv_proizvoda"].'</td>
                                <td>'.$m->getCategoryName($row["kid"]).'</td>
                                <td>'.$row["cena_proizvoda"].'</td>
                                <td>'.$row["kolicina"].'</td>
                                <td></td>
                            </tr>';
                        }
    $output .= '    </table>
                 </div>';
    echo $output;

}else{
    echo "Nema proizvoda koji odgovaraju upitu.";
}
}


?>