<?php

    class Login extends Controllers
    {
        public function __construct()
        {
            session_start();

            if(isset($_SESSION['login'])){
                header('Location:'.base_url().'dashboard');
            }
            parent::__construct();
            
        }

        public function login()
        {
            $data['page_tag'] = "Login";
            $data['page_title'] = "Login";
            $data['page_name'] = "login";
            $data['page_functions_js'] = "functions_login.js";
            $this->views->getView($this,"login",$data);
            
        }

        public function loginUser(){
            if($_POST)
            {
                if(empty($_POST['txtEmail'])||empty($_POST['txtPassword']))
                {
                    $arrResponse = array("status"=>false,"msg"=>"Todos los campos obligatorios");
                }else{
                    $strUsuario = strClean(strtolower($_POST['txtEmail']));
                    $strPassword = strClean($_POST['txtPassword']);
                    $requestUser = $this->model->loginUser($strUsuario,$strPassword);

                    if(empty($requestUser)){
                        $arrResponse = array('status'=> false, 'msg' =>'Usuario o contraseña incorrectos');

                    }else{
                        $arrData = $requestUser;
                        
                        if($arrData['status']==1){
                            $_SESSION['idUser'] = $arrData['idpersona'];
                            $_SESSION['login'] = true;

                            $arrData = $this->model->sessionLogin($_SESSION['idUser']);
                            
                            sessionUser($_SESSION['idUser']);
                            

                            $arrResponse = array('status'=> true, 'msg' =>'OK');

                        }else{
                            $arrResponse = array('status'=> false, 'msg' =>'Usuario inactivo.');
                        }
                    }

                }
      
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);

            }
            die();
        }

        public function resetPass(){
            if($_POST){
                error_reporting(0);
                
                if(empty($_POST['txtEmailReset'])){
                    $arrResponse = array("status"=>false,"msg"=>"Error de datos.");
                }else{
                    $strEmail = strtolower($_POST['txtEmailReset']);
                    $arrData = $this->model->getUserEmail($strEmail);

                    if(empty($arrData)){
                        $arrResponse = array('status'=> false, 'msg' =>'Usuario no existente.');
                    }else{
                        $idpersona = $arrData['idpersona'];
                        $nombreUsuario = $arrData['nombre'].' '.$arrData['apellidos'];

                        $url_recovery = base_url().'login/confirmUser/'.$strEmail.'/';

                        $dataUsuario = array('nombreUsuario' =>$nombreUsuario,
                                                'email' =>$strEmail,
                                                'asunto'=>'Recuperar cuenta - '.NOMBRE_REMITENTE,
                                                'url_recovery' =>  $url_recovery);

                            $sendEmail = sendEmail($dataUsuario,'email_cambioPassword');

                            if($sendEmail){
                            $arrResponse = array('status'=> true, 'msg' =>'Se ha enviado un email a tu cuenta de correo.');

                            }else{
                                $arrResponse = array('status'=> false, 'msg' =>'No se ha podido procesar la solicitud.');

                            }
                    }
                }
               
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }

            
            die();
        }

        public function confirmUser(string $params){
            
            if(empty($params)){
                header('Location: '.base_url());
            }else{
              
                $arrParams = explode(',',$params);
                $strEmail = $arrParams[0];
                $arrResponse = $this->model->getUsuario($strEmail);
                if(empty($arrResponse)){
                    header('Location: '.base_url());
                }else{
                $data['page_tag'] = "Cambiar contraseña";
                $data['page_title'] = "Cambiar contraseña";
                $data['page_name'] = "cambiar_contrasenia";
                $data['idpersona'] = $arrResponse['idpersona'];
                $data['email'] = $strEmail;
                $data['page_functions_js'] = "functions_login.js";
                $this->views->getView($this,"cambiar_password",$data);

                }
           
            }
                
            die();
        }


        public function setPassword(){
            if(empty($_POST['idUsuario']) || empty($_POST['txtEmail']) ||empty($_POST['txtPassword']) || empty($_POST['txtPasswordConfirm']))
            {
                $arrResponse = array("status"=>false,"msg"=>"Error de datos.");

            }else{
                $intIdpersona = intval($_POST['idUsuario']);
                $strPassword = $_POST['txtPassword'];
                $strPasswordConfirm = $_POST['txtPasswordConfirm'];
                $strEmail = $_POST['txtEmail'];

                if($strPassword != $strPasswordConfirm){
                    $arrResponse = array("status"=>false,"msg"=>"Las contraseñas no son iguales");
                }else{
                    $arrResponseUser = $this->model->getUsuario($strEmail);
                    if(empty($arrResponseUser)){
                        $arrResponse = array("status"=>false,"msg"=>"Error de datos.");
                    }else{
                        $requestPass = $this->model->insertPassword($intIdpersona,$strPassword);
                        if($requestPass){
                            $arrResponse = array("status"=>true,"msg"=>"Contraseña actualizada con éxito.");
                        }else{
                            $arrResponse = array("status"=>false,"msg"=>"No es posible realizar el proceso.");

                        }

                    }
                    
                }


            }
            
                echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);             
                die();
        }




    }//fin class
?>