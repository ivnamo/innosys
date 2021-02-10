<?php

    class Roles extends Controllers
    {
        public function __construct()
        {
            parent::__construct();
            session_start();
            session_regenerate_id(true);

            if(empty($_SESSION['login'])){
                header('Location:'.base_url().'login');
            }
            getPermisos(3);
            
        }

        public function roles()
        {
            if(empty($_SESSION['permisosMod']['r'])){
                header('Location:'.base_url().'dashboard');
            }
            $data['page_id'] = 3;
            $data['page_tag'] = "Roles";
            $data['page_title'] = "Roles";
            $data['page_name'] = "roles";
            $data['page_functions_js'] = "functions_roles.js";
            $this->views->getView($this,"roles",$data);
            
        }

        public function getRoles()
        {
            if($_SESSION['permisosMod']['r']){
                $btnView='';
                $btnEdit='';
                $btnDelete='';
                $arrData = $this->model->selectRoles();

                for ($i=0; $i < count($arrData) ; $i++) { 
                    

                    if($arrData[$i]["status"]==1)
                    {
                        $arrData[$i]["status"] = '<span class="badge badge-success">Activo</span>';
                    }else{

                        $arrData[$i]["status"] = '<span class="badge badge-danger">Inactivo</span>';
                    }

                

                
                    if($_SESSION['permisosMod']['u']){
                        $btnView = '<button class="btn btn-secondary btn-sm btnPermisosRol" onClick="fntPermisos('.$arrData[$i]['idrol'].')" title="Permisos"><i class="fas fa-key"></i></button>';
                        $btnEdit ='<button class="btn btn-primary btn-sm btnEditRol" onClick="fntEditRol('.$arrData[$i]['idrol'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
                    }

                    if($_SESSION['permisosMod']['d']){
                        $btnDelete ='<button class="btn btn-danger btn-sm btnDelRol" onClick="fntDelRol('.$arrData[$i]['idrol'].')" title="Eliminar"><i class="far fa-trash-alt"></i></button>';
                    }

                    $arrData[$i]["options"] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
                    
                }

                echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
            }
                die();

        }

        public function getSelectRoles()
        {
            $hmtlOptions="";
            $arrData = $this->model->selectRoles();
            if(count($arrData)>0){
                for ($i=0; $i <count($arrData) ; $i++) {
                    if($arrData[$i]['status']== 1){
                    $hmtlOptions .= '<option value="'.$arrData[$i]['idrol'].'">'.$arrData[$i]['nombrerol'].'</option>';
                    } 
                }
            }
            echo $hmtlOptions;
            die();
        }

        public function getRol(int $idrol)
        {
            if($_SESSION['permisosMod']['r']){
                $intIdrol=intval($idrol);
                if($intIdrol>0)
                {
                    $arrData=$this->model->selectRol($intIdrol);
                    if(empty($arrData))
                    {
                        $arrResponse = array('status'=>false,'msg'=>'Datos no encontrados');
                    }else{
                        $arrResponse = array('status'=>true,'data'=>$arrData);
                    }
                    echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
                }
                die();
            }
        }
            
        public function setRol(){
             //falta funcion limpiar sql injection
             if($_SESSION['permisosMod']['w']){
                $intIdrol = intval($_POST['idRol']);
                $strRol = $_POST['txtNombre'];
                $strDescripcion = $_POST['txtDescripcion'];
                $intStatus = intval($_POST['listStatus']);

                if($intIdrol == 0)
                {
                    //Crear
                    $request_rol = $this->model->insertRol($strRol,$strDescripcion,$intStatus);
                    $option = 1;
                }else{
                    //Actualizar
                    $request_rol = $this->model->updateRol($intIdrol,$strRol,$strDescripcion,$intStatus);
                    $option =2;
                }

                if($request_rol>0)
                {
                    if($option==1)
                    {
                        $arrResponse = array('status'=>true,'msg'=>'Datos guardados correctamente');
                    }else{
                        $arrResponse = array('status'=>true,'msg'=>'Datos actualizados correctamente');
                    }
                
                }else if($request_rol == 'exist'){
                    $arrResponse = array('status'=>false,'msg'=>'El rol ya existe');
                }else{
                    $arrResponse = array('status'=>false,'msg'=>'No es posible almacenar los datos');
                }
                
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
            }
                die();
        }

        public function delRol(){
            if($_POST){
                if($_SESSION['permisosMod']['d']){
                    $intIdrol = intval($_POST['idrol']);
                    $requestDelete = $this->model->deleteRol($intIdrol);
                    if($requestDelete =='ok')
                    {
                            $arrResponse = array('status'=>true,'msg'=>'Se ha eliminado el rol');
                        }else if($requestDelete =='exist'){
                            $arrResponse = array('status'=>false,'msg'=>'No es posible eliminar el rol');
                        }else{
                            $arrResponse = array('status'=>false,'msg'=>'Error al eliminar el rol');
                        }
                        echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
                    }
                    }
                    die();
            
        }
    }
?>