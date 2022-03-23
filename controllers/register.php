<?php

    class Register extends controller{

        function __construct(){

            parent::__construct();
            $this->view->render("register");

        }

        function registrar(){

            if(!empty($_POST["password"]) && !empty($_POST["email"]) && !empty($_POST["repassword"]) && !empty($_POST["telefono"])){

                if ($_POST["password"] == $_POST["repassword"]){
                    $aDatos = array();

                    $email = $_POST["email"];
                    $telefono = $_POST["telefono"];
                    $contra = $_POST["password"];   
                    $premium = $_POST['premium'];

                 

                    $aDatos =array(
                        "email" => $email,
                        "telefono" => $telefono,
                        "password" => $contra,
                        "premium" => $premium
                    );

                    $this->model->registrarUser($aDatos);
                    
                } else{
                    echo "<p> Las password no coinciden </p>";
                }
                
            } else{
                echo "<p>Complete todos los campos</p>";
            }

        }   
    }

?>