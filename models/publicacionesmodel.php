<?php

    class PublicacionesModel extends Model{

        function __construct(){

            parent::__construct();
        }

        function getPublicaciones(){

            session_start();

            $cant_x_pag = 2;

            $bd = $this->db->conexion();

            $resultadoRol = "";
            $consulta = "";
            $publicaciones = "";
            $admin = 0;
            
            if (array_key_exists("rol", $_SESSION)){
        
                $resultadoRol = $bd->prepare("SELECT id
                                            FROM rol
                                            WHERE id = " . $_SESSION['rol'] . "");
                $resultadoRol->execute();
                $rol = $resultadoRol->fetch(PDO::FETCH_OBJ);

               
                //$admin = $rol->rol;
               

            } 
            

            $consulta = "SELECT pu.id as id, pu.fecha, pu.activa, pu.descripcion, (SELECT cat.nombre
                                                                                    FROM categoria as cat
                                                                                    WHERE cat.id = pu.id_categoria) as namecat,  (SELECT u.email
                                                                                                                                    FROM user as u
                                                                                                                                    WHERE u.id = pu.id_user) as usuario
                        FROM publicacion as pu";

         
    
                    
            $publicaciones = $bd->prepare($consulta);
            $publicaciones->execute();

            $resultado = $publicaciones->fetchAll(PDO::FETCH_OBJ);
          
            return $resultado;

            
        }

    }
?>