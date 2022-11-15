<?php

    class DBOperations{
        private $con;

        function  __construct(){
            include_once("../database/db.php");
            $db = new Database();
            $this->con =  $db->connect();
        }


        public function addCategory($name_category){
            $prepared_statement = $this->con->prepare("INSERT INTO kategorija(naziv_kategorije,status) 
                                                        VALUES(?,?)" );
            $status = 1;
            $prepared_statement->bind_param("si", $name_category, $status); 

            $result = $prepared_statement->execute() or die($this->con->error);


            if($result){
                return "CATEGORY_ADDED";
            } else{
                return 0;
            }
        }

        public function getAllRecord($table){
            $prepared_statement = $this->con->prepare("SELECT * FROM ".$table);
            $prepared_statement->execute() or die($this->con->error);
            $result = $prepared_statement->get_result();

            $rows = array();
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    $rows[] = $row;
                }
                return $rows;
            }
            return "NO_DATA";

        }


        public function addProduct($cid,$product_name,$product_price,$product_stock){
            $prepared_statement = $this->con->prepare("INSERT INTO proizvod(kid,naziv_proizvoda,cena_proizvoda,kolicina) 
                                                        VALUES(?,?,?,?)" );
            $prepared_statement->bind_param("isdi", $cid, $product_name,$product_price,$product_stock);   
            $result = $prepared_statement->execute() or die($this->con->error);

            if($result){
                return "PRODUCT_ADDED";
            } else{
                return 0;
            }
        }

    }

    


 //$op = new DBOperations();
//echo $op->addCategory("Rezano cvece");
//print_r($op->getAllRecord("kategorija"));

?>