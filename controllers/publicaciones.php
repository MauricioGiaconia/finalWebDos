<?php

    class Publicaciones extends controller{

        private $mostrar = true;

        function __construct($_mostrar = true){

            parent::__construct();

            $mostrar = $_mostrar;
            
            if ($mostrar){
                $this->view->render("publicaciones");
            }
            
        }

        function traerPublicaciones($categoria, $orden){

            header('Content-Type: application/json');
        
            echo json_encode($this->model->getPublicaciones($categoria, $orden));   
        }

    
        function verPublicacion($xid){

            header('Content-Type: application/json');
        
            echo json_encode($this->model->getPublicaciones($xid));  

        }

        function desactivarPublicacion($xid){
            $this->model->deleteData($xid);
        }

        function nuevaPulicacion(){

            if (!empty($_POST["descripcion"]) && !empty($_POST["categoria"]) &&){
                $aData = array("descripcion" => $_POST["descripcion"],
                                    "categoria" => $_POST["categoria"]);
                $this->model->insertarPulicacion($aData);
            }

            
        }
    }
?>