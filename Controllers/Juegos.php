<?php

    class Juegos extends Controllers
    {
        public function __construct()
        {
            parent::__construct();
            session_start();

            if(empty($_SESSION['login'])){
                header('Location:'.base_url().'login');
            }
            getPermisos(4);
            
        }

        public function juegos()
        {
            if(empty($_SESSION['permisosMod']['r'])){
                header('Location:'.base_url().'dashboard');
            }
            $data['page_tag'] = "Juegos";
            $data['page_title'] = "Juegos";
            $data['page_name'] = "juegos";
            $data['page_functions_js'] = "functions_juegos.js";
            $this->views->getView($this,"juegos",$data);
            
        }
    }
?>