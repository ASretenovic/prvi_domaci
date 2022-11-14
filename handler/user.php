<?php

    class User{

        private $con;

        function __construct() {
            include_once("../database/db.php");
            $db = new Database();
            $this->con = $db->connect();
        }

        // Login
        public function userLogin($email,$password){
            $prepared_statement = $this->con->prepare("SELECT id,username,email,lozinka FROM korisnik WHERE email = ?");
            $prepared_statement->bind_param("s",$email);
            $prepared_statement->execute() or die($this->con->error);
            $result = $prepared_statement->get_result();

            if($result->num_rows < 1){
                return "USER_DOES_NOT_EXIST";
            } else{
                $row = $result->fetch_assoc();
                if(strcmp($password,$row["lozinka"]) == 0){
                    $_SESSION["id"] = $row["id"];
                    $_SESSION["username"] = $row["username"];
                } else{
                    return "PASSWORD_NOT_MATCHED";
                }
            }
        }

    }

//$user = new User();
//echo $user->userLogin("marko@gmail.com","marko123");

?>