<?php

    class PublicacionesModel extends Model{

        function __construct(){

            parent::__construct();
        }

        function getPublicaciones($xcategoria = "", $xorden = ""){

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
                                            WHERE id = $_SESSION['rol']");
                $resultadoRol->execute();
                $rol = $resultadoRol->fetch(PDO::FETCH_OBJ);

               
                $admin = $rol->rol;
               

            } 
            

            $consulta = "SELECT pu.id as id, pu.fecha, pu.activa, pu.descripcion, (SELECT cat.nombre
                                                                                    FROM categoria as cat
                                                                                    WHERE cat.id = pu.id_categoria) as namecat,  (SELECT u.email
                                                                                                                                    FROM user as u
                                                                                                                                    WHERE u.id = pu.id_user) as usuario, 
                                                                                                                                        (SELECT u.premium
                                                                                                                                        FROM user as u
                                                                                                                                        WHERE u.id = pu.id_user) as premium], $admin as admini
                        FROM publicacion as pu
                        WHERE pu.activa = 1";
            if (!empty($xcategoria)){

                $consulta .= " AND pu.id_categoria = $xcategoria
                                ORDER BY $xorden";
            }
         
    
                    
            $publicaciones = $bd->prepare($consulta);
            $publicaciones->execute();

            $resultado = $publicaciones->fetchAll(PDO::FETCH_OBJ);
          
            return $resultado;

            
        }

        function getPublicacion($xid){

            $bd = $this->db->conexion();

            $consulta = "SELECT pu.fecha, pu.descripcion,(SELECT cat.nombre
                                                        FROM categoria as cat
                                                        WHERE cat.id = pu.id_categoria) as namecat,  (SELECT cat.destacada
                                                                                                        FROM categoria as cat
                                                                                                        WHERE cat.id = pu.id_categoria) as destacada,(SELECT u.email
                                                                                                        FROM user as u
                                                                                                        WHERE u.id = pu.id_user) as usuario
                        FROM publicacion as pu
                        WHERE pu.id = $xid";

            return $resultado;
        }

        function desactivarPublicacion($xid){

            $bd = $this->db->conexion();

            $consulta = "UPDATE publicacion as pu
                        SET pu.activa = 0
            
                        WHERE pu.id = $xid";

            $sql = $bd->prepare($consulta);
            $sql->execute();            
        }

        function insertarPublicacion($aData){
            $bd = $this->db->conexion();

            session_start();

            $consultaPremium = "SELECT premium
                            FROM user
                            WHERE id = $_SESSION[id]";

            $sql = $bd->prepare($consultaPremium);
            

            $esPremium = $sql->execute(); 

            $consulta = "INSERT INTO `publicacion`(`fecha`, `activa`, `descripcion`, `id_user`, `id_categoria`)
                        VALUES (CURRENT_TIMESTAMP, 1, $aData[descripcion], $_SESSION['id'], $aData[categoria])";

            if ($esPremium == 0){
                $consulta .= " WHERE (SELECT count(*) FROM publicaciones WHERE id_user = $_SESSION[id]) < 5";
            }        

            $sql = $bd->prepare($consulta);
            $sql->execute();       
        }

    }
?>