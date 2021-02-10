<?php

    class LibretaLider extends Controllers
    {
        public function __construct()
        {
            parent::__construct();
            session_start();

            if(empty($_SESSION['login'])){
                header('Location:'.base_url().'login');
            }
            getPermisos(5);
            
        }

        public function libretaLider()
        {
            
            $data['page_tag'] = "Libreta del Líder";
            $data['page_title'] = "Libreta del Líder";
            $data['page_name'] = "libretaLider";
            $data['page_functions_js'] = "functions_lider.js";
            $this->views->getView($this,"libretaLider",$data);
            
            
        }

        public function getSelectCols()
        {
            $hmtlOptions="";
            $arrData = $this->model->selectCols();
            if(count($arrData)>0){
                for ($i=0; $i <count($arrData) ; $i++) {
                    if($arrData[$i]['status']== 1){
                    $hmtlOptions .= '<option value="'.$arrData[$i]['idpersona'].'">'.$arrData[$i]['nombre']." ".$arrData[$i]['apellidos'].'</option>';
                    } 
                }
            }
            echo $hmtlOptions;
            die();
        }



        public function setEvento(){
            
            if($_POST){


                if(empty($_POST['txtFecha'])||empty($_POST['txtEvento'])||empty($_POST['listColaboradorid'])||empty($_POST['listStatusLider']))
                {
                    $arrResponse = array("status"=>false,"msg"=>"Datos incorrectos.");
                }else{

                    $idLibreta = intval($_POST['idLibreta']);
                    $intLiderid = intval($_SESSION['idUser']);
                    $srtFecha = ($_POST['txtFecha']);
                    $strEvento = ($_POST['txtEvento']);
                    $intColaboradorid = intval($_POST['listColaboradorid']);
                    $intStatusLider = intval($_POST['listStatusLider']);
                    $request ="";

                   
            if($idLibreta==0){

                        if($_SESSION['permisosMod']['w']){
                            $request = $this->model->insertEvento($intLiderid,
                                                                    $srtFecha,
                                                                    $strEvento,
                                                                    $intColaboradorid,
                                                                    $intStatusLider,
                                                                    );

                    }
                }else{

                    if($_SESSION['permisosMod']['u']){
                        $request = $this->model->updateEvento($intLiderid,
                                                                $idLibreta,
                                                                $srtFecha,
                                                                $strEvento,
                                                                $intColaboradorid,
                                                                $intStatusLider,
                                                                );
                    }
                }

                    if($request>0)
                    {
                        $arrResponse = array("status"=>true,"msg"=>"Datos guardados correctamente.");

                    }else{
                        $arrResponse = array("status"=>false,"msg"=>"No es posible almacenar datos.");

                    }


                }
               
                
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);

            }
            die();
       }

       public function getEventos()
       {
        if($_SESSION['permisosMod']['r']){
           
           $arrData = $this->model->selectEventos();
           
           for ($i=0; $i < count($arrData) ; $i++) { 
               
               $btnEdit='';
               $btnDelete='';

            if($arrData[$i]["tipoevento"]==1)
            {
                $arrData[$i]["tipoevento"] = '<span class="badge badge-success">Positivo</span>';
            }else{

                $arrData[$i]["tipoevento"] = '<span class="badge badge-danger">Negativo</span>';
            }

            

            if($_SESSION['permisosMod']['u']){
              
                    $btnEdit='<button class="btn btn-primary btn-sm btnEditEvento" onClick="fntEditEvento('.$arrData[$i]['idlibreta'].')" title="Editar Evento"><i class="fas fa-pencil-alt"></i></button>';
                }else{
                    $btnEdit='<button class="btn btn-primary btn-sm btnEditEvento" disabled><i class="fas fa-pencil-alt"></i></button>';

                }

            

            if($_SESSION['permisosMod']['d']){
                
                $btnDelete='<button class="btn btn-danger btn-sm btnDelEvento" onClick="fntDelEvento('.$arrData[$i]['idlibreta'].')" title="Eliminar Evento"><i class="far fa-trash-alt"></i></button>';
                }else{
                    $btnDelete='<button class="btn btn-danger btn-sm btnDelEvento" disabled><i class="far fa-trash-alt"></i></button>';

                }
            

            $arrData[$i]["nombreCompleto"] = $arrData[$i]["nombre"]." ".$arrData[$i]["apellidos"];
            $arrData[$i]["options"] = '<div class="text-center">'.$btnEdit.' '.$btnDelete.'</div>';
            
        }
        
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
        }
        die();

       }




       public function getEvento($idlibreta){
        if($_SESSION['permisosMod']['r']){
           $idevento = intval($idlibreta);
           if($idevento>0)
           {
               $arrData = $this->model->selectEvento($idlibreta);
               $arrData["nombreCompleto"] = $arrData["nombre"]." ".$arrData["apellidos"];
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

       public function delEvento(){
        if($_POST){

            

            if($_SESSION['permisosMod']['d']){

                $intIdlibreta = intval($_POST['idlibreta']);
                $requestDelete = $this->model->deleteEvento($intIdlibreta);
                if($requestDelete =='ok')
                {
                        $arrResponse = array('status'=>true,'msg'=>'Se ha eliminado el evento');
                    
                    }else{
                        $arrResponse = array('status'=>false,'msg'=>'Error al eliminar el evento');
                    }

             
                    echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
                }
                }
                die();
        
    }
    
    
    
    
////INDICADORES LIBRETA DEL LIDER

    public function indLibretaLider()
    {
   
        $data['page_tag'] = "Indicadores del Líder";
        $data['page_title'] = "Indicadores del Líder";
        $data['page_name'] = "indLibretaLider";
        $data['page_functions_js'] = "functions_lider.js";
        $this->views->getView($this,"indLibretaLider",$data);
        
    }

    public function getIndLibretaLider()
       {
        if($_SESSION['permisosMod']['r']){

            if(isset($_POST['fechaInicio']) AND isset($_POST['fechaFin'])){
                $fechaInicio = $_POST['fechaInicio'];
                $fechaFin = $_POST['fechaFin']; 
            }else{
                $fechaInicio = "";
                $fechaFin = "";
            }

           
           $arrData = $this->model->selectIndEventos($fechaInicio,$fechaFin);
          
           
           for ($i=0; $i < count($arrData) ; $i++) { 
            $arrData[$i]["porcentajepos"] = number_format(floatval(($arrData[$i]["pos"]/$arrData[$i]["total"])*100),0,",",".");
            $arrData[$i]["porcentajeneg"] = number_format(floatval((100-$arrData[$i]["porcentajepos"])),0,",",".");

            if($arrData[$i]["porcentajepos"]>=80) {
                $arrData[$i]["porcentajepos"] = '<span class="badge badge-success">'.$arrData[$i]["porcentajepos"].'</span>';

            }else if($arrData[$i]["porcentajepos"]>=50 AND $arrData[$i]["porcentajepos"]<80) {
                $arrData[$i]["porcentajepos"] = '<span class="badge badge-warning">'.$arrData[$i]["porcentajepos"].'</span>';

            }else{
                $arrData[$i]["porcentajepos"] = '<span class="badge badge-danger">'.$arrData[$i]["porcentajepos"].'</span>';
            }

            if($arrData[$i]["porcentajeneg"]>=80) {
                $arrData[$i]["porcentajeneg"] = '<span class="badge badge-danger">'.$arrData[$i]["porcentajeneg"].'</span>';

            }else if($arrData[$i]["porcentajeneg"]>=50 AND $arrData[$i]["porcentajeneg"]<80) {
                $arrData[$i]["porcentajeneg"] = '<span class="badge badge-warning">'.$arrData[$i]["porcentajeneg"].'</span>';

            }else{
                $arrData[$i]["porcentajeneg"] = '<span class="badge badge-success">'.$arrData[$i]["porcentajeneg"].'</span>';
            }
        }

        
       
        echo json_encode($arrData, JSON_UNESCAPED_UNICODE);

        }
        die();

       }


       public function setFechasDatepicker()
       {
        

           $arrData = $this->model->selectIndEventosFechas();

           if(empty($arrData))
           {
               $arrResponse = array('status'=>false,'msg'=>'Datos no encontrados');
           }else{
               $arrResponse = array('status'=>true,'data'=>$arrData);
           }
    
        echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
        
        
        die();

       }







    }//fin class
?>