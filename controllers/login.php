<?php

    class Login extends controller{

        function __construct(){

            parent::__construct();
            $this->view->render("login");

        }

        function logearUser(){

            $aDatos = array();

            if (!empty($_POST["email"]) && !empty($_POST["password"])){

                $aDatos = array(
                    "email" => $_POST["email"],
                    "password" => $_POST["password"]
                );

                $this->model->logear($aDatos);
            }

            
        }

    
    }

?>