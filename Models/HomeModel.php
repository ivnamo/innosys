<?php

    class HomeModel extends Mysql
    {
        public function __construct()
        {
            parent::__construct();
        }
        


        public function selectCols()
        {
            $this->intIdUser = $_SESSION['idUser'];

            $whereResp="";

            if($_SESSION['userData']['idrol']>2){
                $whereResp=" AND superiorid = $this->intIdUser";
            }
         
            $sql = "SELECT * FROM persona WHERE status !=0 AND idpersona != $this->intIdUser AND idpersona !=1 AND rolid < 5".$whereResp;
            $request = $this->select_all($sql);
            return $request;
        }

        public function insertSolicitud(int $user,int $intListSeccion,int $intListCategoria,string $strObjetivo,int $intListPrioridad)
        {

         $this->intUser = $user;
         $this->intListSeccion = $intListSeccion;
         $this->intListCategoria = $intListCategoria;
         $this->strObjetivo = $strObjetivo;
         $this->intListPrioridad = $intListPrioridad;
         
         $query_insert = "INSERT INTO solicitud(
             personaid, 
             seccion, 
             categoria,
             descripcion,
             prioridad) VALUES (?,?,?,?,?)";
         
         $arrData = array(
         $this->intUser, 
         $this->intListSeccion,
         $this->intListCategoria,
         $this->strObjetivo,
         $this->intListPrioridad);

         $request_insert = $this->insert($query_insert,$arrData);
            
         return $request_insert;
            

        }

        public function updateSolicitud(int $solicitud, int $idUsuario,int $intListSeccion,int $intListCategoria,string $strObjetivo,int $intListPrioridad, string $strSolucion, string $strComentarios, int $intListResponsable)
        {
            $this->intIdSolicitud = $solicitud;
            $this->intIdUsuario = $idUsuario;
            $this->intListSeccion = $intListSeccion;
            $this->intListCategoria = $intListCategoria;
            $this->strObjetivo = $strObjetivo;
            $this->intListPrioridad = $intListPrioridad;
            $this->strSolucion = $strSolucion;
            $this->strComentarios = $strComentarios;
            $this->intListResponsable = $intListResponsable;

            
            if(strlen($strSolucion)>0){//SI HAY SOLUCION ESCRITA
                
                $sql = "UPDATE solicitud 
                SET seccion=?, categoria=?,descripcion=?, prioridad=? ,responsableid=?,solucion=?, comentarios=?
                WHERE idsolicitud = $this->intIdSolicitud";
                
                $arrData = array(
                $this->intListSeccion,
                $this->intListCategoria,
                $this->strObjetivo,
                $this->intListPrioridad,
                $this->intListResponsable,
                $this->strSolucion,
                $this->strComentarios);

                if($_SESSION['userData']['idrol']<5){
                    $this->updateEstadoSolicitud($solicitud,5);//RESUELTO
                }
        
            }else{//NO HAY SOLUCION ESCRITA
                $sql = "UPDATE solicitud 
                SET seccion=?, categoria=?,descripcion=?, prioridad=? ,responsableid=?,solucion=?, comentarios=?
                WHERE idsolicitud = $this->intIdSolicitud";
                
                $arrData = array(
                $this->intListSeccion,
                $this->intListCategoria,
                $this->strObjetivo,
                $this->intListPrioridad,
                $this->intListResponsable,
                $this->strSolucion, 
                $this->strComentarios);

            
                if($_SESSION['userData']['idrol']<4 AND $intListResponsable!=$_SESSION['idUser']){
                    $this->updateEstadoSolicitud($solicitud,3);//DELEGADO
                }

              
            }
                
            $request=$this->update($sql,$arrData);

            return $request;

        }


        public function selectSolicitudes()
        {
            $this->intIdUsuario = $_SESSION['idUser'];
            $getSoli="";
            

            if($_SESSION['userData']['idrol']==5)
            {
                $getSoli = " AND s.personaid ='{$this->intIdUsuario}'";

            }else if($_SESSION['userData']['idrol']==3 OR $_SESSION['userData']['idrol']==4){

                $getSoli = " AND s.status !=5 AND s.responsableid ='{$this->intIdUsuario}'";

            }

            $sql = "SELECT  s.idsolicitud,
                           CONCAT(p.nombre,' ',p.apellidos) as nombreSolicitante,
                            s.seccion,
                            s.categoria,
                            s.descripcion, 
                            DATE_FORMAT(s.datecreated, '%d-%m-%Y') as fechaSolicitud,
                            s.responsableid,
                            DATE_FORMAT(s.datefin, '%d-%m-%Y') as fechaSolucion,
                            s.prioridad,
                            s.solucion,
                            s.valuser,
                            s.comentarios,
                            s.status                     
                    FROM solicitud s
                    INNER JOIN persona p ON s.personaid = p.idpersona
                    WHERE s.status != 0".$getSoli;

                    $request = $this->select_all($sql);

                    
               
                    return $request;
        }

        
        public function updateEstadoSolicitud(int $idsolicitud, int $estado)
        {
            $this->intIdSolicitud = $idsolicitud;
            $this->intEstado = $estado;

            $sql = "SELECT dategest,datedeleg,dateongo,datefin
            FROM solicitud
            WHERE idsolicitud = '{$this->intIdSolicitud}'";

            $r = $this->select($sql);

            
            $dateGest = new DateTime($r['dategest']);
            $newDateGest = $dateGest->format('Y');

            $dateDeleg = new DateTime($r['datedeleg']);
            $newDateDeleg = $dateDeleg->format('Y');

            $dateOngo = new DateTime($r['dateongo']);
            $newDateOngo = $dateOngo->format('Y');

            $dateFin = new DateTime($r['datefin']);
            $newDateFin = $dateFin->format('Y');

            


            
            switch ($this->intEstado) 
            {

            case 2://Recibido
                if($newDateGest<0){
                    $sql = "UPDATE solicitud SET dategest=?, status=? WHERE idsolicitud = $this->intIdSolicitud";
                    $arrData = array(date("Y-m-d H:i:s"),$this->intEstado);
                
                }else{
                    $sql = "UPDATE solicitud SET status=? WHERE idsolicitud = $this->intIdSolicitud";
                    $arrData = array($this->intEstado);
                }
                break;

            case 3://Delegado
                if($newDateDeleg<0){
                    $sql = "UPDATE solicitud SET datedeleg=?, status=? WHERE idsolicitud = $this->intIdSolicitud";
                    $arrData = array(date("Y-m-d H:i:s"),$this->intEstado);
                    
                }else{
                    $sql = "UPDATE solicitud SET status=? WHERE idsolicitud = $this->intIdSolicitud";
                    $arrData = array($this->intEstado);
                }
                break;
                
            case 4://Revisando
                if($newDateOngo<0){
                    $sql = "UPDATE solicitud SET dateongo=?, status=? WHERE idsolicitud = $this->intIdSolicitud";
                    $arrData = array(date("Y-m-d H:i:s"),$this->intEstado);
                
                }else{
                    $sql = "UPDATE solicitud SET status=? WHERE idsolicitud = $this->intIdSolicitud";
                    $arrData = array($this->intEstado);
                }
                break;

            case 5://Resuelto
                if($newDateFin<0){
                    $sql = "UPDATE solicitud SET datefin=?, status=? WHERE idsolicitud = $this->intIdSolicitud";
                    $arrData = array(date("Y-m-d H:i:s"),$this->intEstado);
                
                }else{
                    $sql = "UPDATE solicitud SET status=? WHERE idsolicitud = $this->intIdSolicitud";
                    $arrData = array($this->intEstado);
                }
                break;
            
            case 6://Valorado
                        $sql = "UPDATE solicitud SET status=? WHERE idsolicitud = $this->intIdSolicitud";
                        $arrData = array($this->intEstado);
                   
                    break;
            }

            
        
            $this->update($sql,$arrData);


           // return $request;


        }
        
        public function selectSolicitud(int $idsolicitud)
        {
            $this->intIdSolicitud = $idsolicitud;

            $sql = "SELECT idsolicitud,seccion,categoria,descripcion,prioridad,responsableid,solucion,valuser,comentarios,status
                    FROM solicitud
                    WHERE idsolicitud = '{$this->intIdSolicitud}'";

                    $request = $this->select($sql);

            if($_SESSION['userData']['idrol']==2 AND $request['status']==1){
                $this->updateEstadoSolicitud($idsolicitud,2);// RECIBIDO
            }

            if($_SESSION['userData']['idrol']<5 AND $request['status']==3){
                $this->updateEstadoSolicitud($idsolicitud,4);// REVISANDO
            }

            if($_SESSION['userData']['idrol']==5 AND $request['status']==5 AND $request['valuser']>0){
                $this->updateEstadoSolicitud($idsolicitud,6);// VALORADO
                }
                   
                    //$request = $this->select($sql);
                    return $request;
        }


        public function deleteSolicitud(int $intIdSolicitud)
        {
            $this->intIdSolicitud = $intIdSolicitud;
            $sql = "UPDATE solicitud SET status = ? WHERE idsolicitud = $this->intIdSolicitud";
            $arrData = array(0);
            $request = $this->update($sql,$arrData);
            return $request;


        }


        public function updateValoracionSolucion(int $idsolicitud, int $valoracion)
        {
            $this->intIdSolicitud = $idsolicitud;
            $this->intValoracion = $valoracion;
            

                    $sql = "UPDATE solicitud SET valuser=? WHERE idsolicitud = $this->intIdSolicitud";
                    $arrData = array($this->intValoracion);
                
        
                    $request = $this->update($sql,$arrData);


           return $request;


        }


    }//fin class


?>