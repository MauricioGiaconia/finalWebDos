<?php


    class Registermodel extends Model{

        function __construct(){
            parent::__construct();
        }

        function registrarUser($aDatos){

            $conexion = $this->db->conexion();

            $consulta = "SELECT email
                            FROM user
                            WHERE email = '$aDatos[email]'";

            $resultado = $conexion->prepare($consulta);

            $resultado->execute();

            $aResultado = $resultado->fetchAll(PDO::FETCH_OBJ);

            $existe = false;

            if (count($aResultado) > 0){
                         
                $existe = true;

                foreach($aResultado as $usuarioE){

                    if ($usuarioE->email == $aDatos["email"]){
                        echo "Usuario existente, elija otro";
                        echo "<br>";
                    } 

            }
            
            if(!$existe){

                $contraHash = password_hash($aDatos['password'], PASSWORD_BCRYPT);

                $sql = "INSERT INTO user(email, telefono, passw, premium, rol) 
                        SELECT '$aDatos[email]', '$aDatos[telefono], '$contraHash', '$aDatos[premium]', '1'
                        WHERE NOT EXISTS (SELECT email
                                        FROM user
                                        WHERE email = '$aDatos[email]')";

                $conexion->exec($sql);

                include_once ("loginmodel.php");

                $login = new Loginmodel();

                $login->logear($aDatos);

            } else{
                //Agregar cartel de usuario existente
            }
            
            
            

        }
        
    }
}

?>