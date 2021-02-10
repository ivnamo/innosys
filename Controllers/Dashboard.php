<?php

    class Dashboard extends Controllers
    {
        public function __construct()
        {
            parent::__construct();

            session_start();
            session_regenerate_id(true);

            if(empty($_SESSION['login'])){
                header('Location:'.base_url().'login');
            }

            getPermisos(1);
            
        }

        public function dashboard()
        {
            $data['page_id'] = 2;
            $data['page_tag'] = "Dashboard ATA InnoSyS";
            $data['page_title'] = "Dashboard InnoSyS";
            $data['page_name'] = "dashboard";
            $data['page_functions_js'] = "functions_dashboard.js";
            $this->views->getView($this,"dashboard",$data);
            
        }


        public function indicadorUsuarios()
        {
            $arrData = $this->model->selectUsers();
            if(empty($arrData))
            {
                $arrResponse = array('status'=>false,'msg'=>'Datos no encontrados');
            }else{
                $arrResponse = array('status'=>true,'data'=>$arrData);
            }

           
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            die();
        }


    
    }//fin class

?>