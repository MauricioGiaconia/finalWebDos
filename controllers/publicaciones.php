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

        function traerPublicaciones($categoria){

            header('Content-Type: application/json');
        
            echo json_encode($this->model->getPublicaciones($categoria));   
        }

    
        function verPublicacion($xid){

            header('Content-Type: application/json');
        
            echo json_encode($this->model->getPublicaciones($xid));  

        }

        function desactivarPublicacion($xid){
            $this->model->deleteData($xid);
        }
    }
?>