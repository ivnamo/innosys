<?php

    class Home extends Controllers
    {
        

        public function __construct()
        {
            parent::__construct();
            
            session_start();

            if(empty($_SESSION['login'])){
                header('Location:'.base_url().'login');
            }

            getPermisos(6);
            
        }

        public function home()
        {
            
            $data['page_tag'] = "InnoSys";
            $data['page_title'] = "Página principal";
            $data['page_name'] = "home";
            $data['page_functions_js'] = "functions_home.js";
            $this->views->getView($this,"home",$data);
            
        }


        public function setSolicitud(){
            
            if($_POST){
       

                if(empty($_POST['listSeccion'])||empty($_POST['listCategoria'])||empty($_POST['txtObjetivo'])||empty($_POST['listPrioridad']))
                {
                    $arrResponse = array("status"=>false,"msg"=>"Datos incorrectos.");
                }else{

                    
                    $idUsuario = intval($_SESSION['idUser']);
                    $intListSeccion = intval($_POST['listSeccion']);
                    $intListCategoria = intval($_POST['listCategoria']);
                    $strObjetivo = strClean(strCleanCom($_POST['txtObjetivo']));
                    $intListPrioridad = intval($_POST['listPrioridad']);


                    $request_sol ="";


                        //if($_SESSION['permisosMod']['w']){
                            $request_sol = $this->model->insertSolicitud($idUsuario,
                                                                    $intListSeccion,
                                                                    $intListCategoria,
                                                                    $strObjetivo,
                                                                    $intListPrioridad
                                                                    );
                        //}                   
                    if($request_sol>0)
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

       //Editar solicitud
       public function editSolicitud(){
            
        if($_POST){
         
            if(empty($_POST['idSolicitudEdit'])||empty($_POST['listSeccionEdit'])||empty($_POST['listCategoriaEdit'])||empty($_POST['txtObjetivoEdit'])||empty($_POST['listPrioridadEdit']))
            {
                $arrResponse = array("status"=>false,"msg"=>"Datos incorrectos.");
            }else{


                $idSolicitud = intval($_POST['idSolicitudEdit']);
                $idUsuario = intval($_SESSION['idUser']);
                $intListSeccionEdit = intval($_POST['listSeccionEdit']);
                $intListCategoriaEdit = intval($_POST['listCategoriaEdit']);
                $strObjetivoEdit = strClean(strCleanCom($_POST['txtObjetivoEdit']));
                $intListPrioridadEdit = intval($_POST['listPrioridadEdit']);
                $strComentariosEdit = $_POST['txtComentariosEdit']; 
                $strSolucionEdit = strClean(strCleanCom($_POST['txtSolucionEdit']));
                $intListResponsableEdit ="";

                if(empty($_POST['listResponsableEdit'])){
                    $intListResponsableEdit = $idUsuario;
                   
                }else{
                    if(intval($_POST['listResponsableEdit'])==0){
                        $intListResponsableEdit = $idUsuario;
                    }else{
                        $intListResponsableEdit = intval($_POST['listResponsableEdit']);
                    }
                }

                $request_sol ="";
                    //if($_SESSION['permisosMod']['u']){
                        $request_sol = $this->model->updateSolicitud($idSolicitud,
                                                                    $idUsuario,
                                                                    $intListSeccionEdit,
                                                                    $intListCategoriaEdit,
                                                                    $strObjetivoEdit,
                                                                    $intListPrioridadEdit,
                                                                    $strSolucionEdit,
                                                                    $strComentariosEdit,
                                                                    $intListResponsableEdit
                                                                );
                    //}
               
                if($request_sol>0)
                {
                    $arrResponse = array("status"=>true,"msg"=>"Datos actualizados correctamente.");
                    
                }else{
                    $arrResponse = array("status"=>false,"msg"=>"No es posible almacenar datos.");
                }
            }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
        }
        die();
   }



       public function getSolicitudes()
       {
      //  if($_SESSION['permisosMod']['r']){
           
           $arrData = $this->model->selectSolicitudes();
           
           for ($i=0; $i < count($arrData) ; $i++) { 
               $btnView='';
               $btnEdit='';
               $btnDelete='';
            
          
           
           //title dinamico en el objetivo 
           $arrData[$i]['descripcion'] = '<span title="'.$arrData[$i]['descripcion'].'">'.$arrData[$i]['descripcion'].'</span>';

           //clase pendiente leer estado 

           switch ($arrData[$i]['status']) 
                {
                case 1:
                    $arrData[$i]['statusNombre'] = '<span class="estadoPendiente"><strong>Pendiente</strong></span>';
                    break;
                case 2:
                    $arrData[$i]['statusNombre'] = '<span class="estadoGestion"><strong>Recibido</strong></span>';
                    break;
                case 3:
                    $arrData[$i]['statusNombre'] = '<span class="estadoDelegado"><strong>Delegado</strong></span>';
                    break;
                case 4:
                    $arrData[$i]['statusNombre'] = '<span class="estadoRevision"><strong>Revisando</strong></span>';
                    break;
                case 5:
                    $arrData[$i]['statusNombre'] = '<span class="estadoSolucionado"><strong>Resuelto</strong></span>';
                    break;
                case 6:
                    $arrData[$i]['statusNombre'] = '<span class="estadoValorado"><strong>Valorado</strong></span>';
                    break;
                }
          
           
          
            
            //formato select seccion

            if($arrData[$i]["seccion"]==1)
            {
                $arrData[$i]["seccion"] = '<span title="Bioestimulante">Bioest.</span>';
            }else{

                $arrData[$i]["seccion"] = 'Biocontrol';
            }

            //formato select categoria

            switch ($arrData[$i]["categoria"]) 
                {
                case 1:
                    $arrData[$i]["categoria"] = 'Nuevo Producto';
                    break;
                case 2:
                    $arrData[$i]["categoria"] = '<span title="Modificación Producto">Mod. Producto</span>';
                    break;
                case 3:
                    $arrData[$i]["categoria"] = 'Ensayo';
                    break;
                case 4:
                    $arrData[$i]["categoria"] = 'Idea/Problema';
                    break;
                case 5:
                    $arrData[$i]["categoria"] = 'Muestra I+D';
                    break;
                }
            
            //formato select prioridad

            switch ($arrData[$i]["prioridad"]) 
                {
                case 1:
                    $arrData[$i]["prioridad"] = '<span class="badge badge-success">Baja</span>';
                    break;
                case 2:
                    $arrData[$i]["prioridad"] = '<span class="badge badge-warning">Media</span>';
                    break;
                case 3:
                    $arrData[$i]["prioridad"] = '<span class="badge badge-danger">Alta</span>';
                    break;
                }


            //botones

            if($_SESSION['permisosMod']['r'])
            {
                    $btnView='<button class="btn btn-info btn-sm btnViewUsuario" onClick="fntViewSolicitud('.$arrData[$i]['idsolicitud'].')" title="Ver Solicitud"><i class="far fa-eye"></i></button>';
            }

            if($_SESSION['permisosMod']['u'])
            {
                    $btnEdit='<button class="btn btn-primary btn-sm btnEditSolicitud" onClick="fntEditSolicitud(' .$arrData[$i]['idsolicitud'].')" title="Editar Solicitud"><i class="fas fa-pencil-alt"></i></button>';
            }

            if($_SESSION['permisosMod']['d'])
            {
                    $btnDelete='<button class="btn btn-danger btn-sm btnDelSolicitud" onClick="fntDelSolicitud('.$arrData[$i]['idsolicitud'].')" title="Eliminar Solicitud"><i class="far fa-trash-alt"></i></button>';
            }

                    $btnUndo='<button class="btn btn-info btn-sm" onClick="fntUndoSolicitud('.$arrData[$i]['idsolicitud'].')" title="Deshacer Estado"><i class="fas fa-undo"></i></button>';

        
        
    

            $arrData[$i]["options"] = '<div class="text-center contenedorOptions">'.$btnView."".$btnEdit."".$btnDelete."". $btnUndo.'</div>';
            
            }

            echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
            //}
            die();

        }


       public function getSolicitud($idsolicitud){
        
           $idsol = intval($idsolicitud);
           if($idsol>0)
           {
               
             $arrData = $this->model->selectSolicitud($idsol);
            }
              


               
               
               if(empty($arrData))
               {
                   $arrResponse = array('status'=>false,'msg'=>'Datos no encontrados');
               }else{


                    if($arrData['valuser']==1){
                        //me gusta
                        $arrData['valuserIcon']='<span class="valUserActivo"><i class="fas fa-thumbs-up"></i></span>';
                    }else if($arrData['valuser']==2){
                        //no me gusta
                        $arrData['valuserIcon']='<span class="valUserActivo"><i class="fas fa-thumbs-down"></i></span>';
                    }



                    

                   $arrResponse = array('status'=>true,'data'=>$arrData);
               }
               echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            
           
           die();
       }

       public function delSolicitud()
       {
           if($_POST){
            if($_SESSION['permisosMod']['d']){
                $intIdSolicitud = intval($_POST['idSolicitud']);
                $requestDelete = $this->model->deleteSolicitud($intIdSolicitud);
                if($requestDelete)
                {
                    $arrResponse = array('status'=>true,'msg'=>'Se ha eliminado la solicitud.');
                    }else{
                        $arrResponse = array('status'=>false,'data'=>'Error al eliminar la solicitud.');
                    }
                    echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
                }

               }
               die();
        }


        public function valorarSolucion(){
        
            if($_POST){
                $idSolicitudView = intval($_POST['idSolicitudView']);
                $intValoracion = intval($_POST['intValoracion']);

            }
            
          
            $request_sol ="";
           
                $request_sol = $this->model->updateValoracionSolucion($idSolicitudView,
                                                                        $intValoracion
                                                                                    );
            
       

        

        if($request_sol>0)
        {
            $this->model->selectSolicitud($idSolicitudView);
            $arrResponse = array("status"=>true,"msg"=>"Datos actualizados correctamente.");
            
        }else{
            $arrResponse = array("status"=>false,"msg"=>"No es posible almacenar datos.");
        }
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
             
            
            die();
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

            if($_SESSION['userData']['idrol']==1 OR $_SESSION['userData']['idrol']==2 OR $_SESSION['userData']['idrol']==3){
            $hmtlOptions='<option value="0">No se asigna responsable</option>'. $hmtlOptions;
            }
            echo $hmtlOptions;
            die();
        }












    }//fin class
?>