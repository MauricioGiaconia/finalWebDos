<?php


    class Loginmodel extends Model{

        function __construct(){
            parent::__construct();
        }

        function logear($aDatos){

            $conexion = $this->db->conexion();

            $consulta = "SELECT * 
                        FROM user
                        WHERE email = ?";

            $resultado = $conexion->prepare($consulta);

            $resultado->execute(array($aDatos["email"]));
            $user = $resultado->fetch(PDO::FETCH_OBJ);


            if ($user && password_verify($aDatos["password"], ($user->passw))){
      
                $_SESSION["id"] = $user->user_id;
                $_SESSION["email"] = $email;
                $_SESSION["premium"] = $user->premium;
                $_SESSION["rol"] = $user->id_rol;
                $_SESSION["logged"] = true;

                header("Location: " . constant("URL"));

            } else{

                

            }
            
            

        }
        
    }

?>