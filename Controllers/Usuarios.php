<?php

    class Usuarios extends Controllers
    {
        public function __construct()
        {
            parent::__construct();
            session_start();
            session_regenerate_id(true);

            if(empty($_SESSION['login'])){
                header('Location:'.base_url().'login');
            }
            getPermisos(2);
            
        }

        public function usuarios()
        {
            if(empty($_SESSION['permisosMod']['r'])){
                header('Location:'.base_url().'dashboard');
            }
            $data['page_tag'] = "Usuarios";
            $data['page_title'] = "Usuarios";
            $data['page_name'] = "usuarios";
            $data['page_functions_js'] = "functions_usuarios.js";
            $this->views->getView($this,"usuarios",$data);
            
        }


        public function setUsuario(){
            
            if($_POST){
               

                if(empty($_POST['txtUser'])||empty($_POST['txtEmail'])||empty($_POST['txtNombre'])||empty($_POST['txtApellido'])||empty($_POST['listRolid'])||empty($_POST['listStatus']))
                {
                    $arrResponse = array("status"=>false,"msg"=>"Datos incorrectos.");
                }else{

                    $idUsuario = intval($_POST['idUsuario']);
                    $strUser = strtoupper($_POST['txtUser']);
                    $strEmail = strtolower($_POST['txtEmail']);
                    $strNombre = ucwords($_POST['txtNombre']);
                    $strApellido = ucwords($_POST['txtApellido']);
                    $intTipo = intval($_POST['listRolid']);
                    $intStatus = intval($_POST['listStatus']);
                    $strPassword = $_POST['txtPassword'];
                    $request_user ="";

                    if($idUsuario==0)
                    {
                        $option = 1;
                        if($_SESSION['permisosMod']['w']){
                            $request_user = $this->model->insertUsuario($strUser,
                                                                    $strEmail,
                                                                    $strNombre,
                                                                    $strApellido,
                                                                    $strPassword,
                                                                    $intTipo,
                                                                    $intStatus);
                        }
                    }else{

                        $option = 2;
                        $strPassword = empty($_POST['txtPassword'])?"": $_POST['txtPassword'];
                        if($_SESSION['permisosMod']['u']){
                            $request_user = $this->model->updateUsuario($idUsuario,
                                                                    $strUser,
                                                                    $strEmail,
                                                                    $strNombre,
                                                                    $strApellido,
                                                                    $strPassword,
                                                                    $intTipo,
                                                                    $intStatus);
                        }

                    }

                   
                    if($request_user>0)
                    {
                        if($option ==1){
                            $arrResponse = array("status"=>true,"msg"=>"Datos guardados correctamente.");

                        }else{
                            $arrResponse = array("status"=>true,"msg"=>"Datos actualizados correctamente.");

                        }
                    }else if($request_user == 'exist'){
                        $arrResponse = array("status"=>false,"msg"=>"Email de usuario ya existe.");

                    }else{
                        $arrResponse = array("status"=>false,"msg"=>"No es posible almacenar datos.");

                    }


                }
                
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);

            }
            die();
       }


       public function getUsuarios()
       {
        if($_SESSION['permisosMod']['r']){
           
           $arrData = $this->model->selectUsuarios();
           for ($i=0; $i < count($arrData) ; $i++) { 
               $btnView='';
               $btnEdit='';
               $btnDelete='';

            if($arrData[$i]["status"]==1)
            {
                $arrData[$i]["status"] = '<span class="badge badge-success">Activo</span>';
            }else{

                $arrData[$i]["status"] = '<span class="badge badge-danger">Inactivo</span>';
            }

            if($_SESSION['permisosMod']['r']){
                $btnView='<button class="btn btn-info btn-sm btnViewUsuario" onClick="fntViewUsuario('.$arrData[$i]['idpersona'].')" title="Ver Usuario"><i class="far fa-eye"></i></button>';
            }

            if($_SESSION['permisosMod']['u']){
                if(($_SESSION['idUser']==1 && $_SESSION['userData']['idrol']==1)||
                    ($_SESSION['userData']['idrol']==1 && $arrData[$i]['idrol']!=1))
                {
                    $btnEdit='<button class="btn btn-primary btn-sm btnEditUsuario" onClick="fntEditUsuario('.$arrData[$i]['idpersona'].')" title="Editar Usuario"><i class="fas fa-pencil-alt"></i></button>';
                }else{
                    $btnEdit='<button class="btn btn-primary btn-sm btnEditUsuario" disabled><i class="fas fa-pencil-alt"></i></button>';

                }

            }

            if($_SESSION['permisosMod']['d']){
                
                if(($_SESSION['idUser']==1 && $_SESSION['userData']['idrol']==1)||
                ($_SESSION['userData']['idrol']==1 AND $arrData[$i]['idrol']!=1) 
                AND ($_SESSION['userData']['idpersona'] != $arrData[$i]['idpersona'])){

                $btnDelete='<button class="btn btn-danger btn-sm btnDelUsuario" onClick="fntDelUsuario('.$arrData[$i]['idpersona'].')" title="Eliminar Usuario"><i class="far fa-trash-alt"></i></button>';
            }else{
                $btnDelete='<button class="btn btn-danger btn-sm btnDelUsuario" disabled><i class="far fa-trash-alt"></i></button>';

            }
        }

            $arrData[$i]["options"] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
            
        }

        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        }
        die();

       }


       public function getUsuario($idpersona){
        if($_SESSION['permisosMod']['r']){
           $idusuario = intval($idpersona);
           if($idusuario>0)
           {
               $arrData = $this->model->selectUsuario($idusuario);
               if(empty($arrData))
               {
                   $arrResponse = array('status'=>false,'msg'=>'Datos no encontrados');
               }else{
                   $arrResponse = array('status'=>true,'data'=>$arrData);
               }
               echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
           }
           die();
       }


       public function delUsuario()
       {
           if($_POST){
            if($_SESSION['permisosMod']['d']){
                $intIdpersona = intval($_POST['idUsuario']);
                $requestDelete = $this->model->deleteUsuario($intIdpersona);
                if($requestDelete)
                {
                    $arrResponse = array('status'=>true,'msg'=>'Se ha eliminado el usuario.');
                    }else{
                        $arrResponse = array('status'=>false,'data'=>'Error al eliminar el usuario.');
                    }
                    echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
                }

               }
               die();
        }
       
        public function perfil(){
            $data['page_tag'] = "Perfil";
            $data['page_title'] = "Perfil de usuario";
            $data['page_name'] = "perfil";
            $data['page_functions_js'] = "functions_usuarios.js";
            $this->views->getView($this,"perfil",$data);

        }

        public function putPerfil(){
            if($_POST){
                if(empty($_POST['txtUser'])||empty($_POST['txtNombre'])||empty($_POST['txtApellido']))
                {
                    $arrResponse = array("status"=>false,"msg"=>"Datos incorrectos.");
                }else{

                    $idUsuario = $_SESSION['idUser'];
                    $strUser = strtoupper($_POST['txtUser']);
                    $strNombre = ucwords($_POST['txtNombre']);
                    $strApellido = ucwords($_POST['txtApellido']);
                    $strPassword="";
                    if(!empty($_POST['txtPassword'])){
                        $strPassword = $_POST['txtPassword'];
                    }

                    $request_user = $this->model->updatePerfil($idUsuario,
                                                                $strUser,
                                                                $strNombre,
                                                                $strApellido,
                                                                $strPassword
                                                                );


                  if($request_user)
                    {
                        sessionUser($_SESSION['idUser']);
                        $arrResponse = array("status"=>true,"msg"=>"Datos actualizados correctamente.");
                    }else{
                        $arrResponse = array("status"=>false,"msg"=>"No es posible actualizar datos.");

                    }

                }
               
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);

            }
            die();

        }


        public function setImageAvatar(){
          
            if($_SESSION){
                $idUsuario = intval($_SESSION['idUser']);
                $avatar = $_FILES['foto'];
                $imgNombre = 'avatar_'.$idUsuario.'.jpg';
                $request_image = $this->model->insertImage($idUsuario,$imgNombre);
                if($request_image){
                    $destino = 'Assets/images/uploads/avatar/'.$imgNombre;
                    $uploadImage = uploadImage($avatar,$destino);
                    $arrResponse = array('status'=>true, 'imgname'=>$imgNombre, 'msg' =>'Imagen cargada correctamente');
                }else{
                    $arrResponse = array('status'=>false, 'msg' =>'Error de carga');
                }
                    
                    echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
             die();
        }
            

        
        









    }//fin class
?>