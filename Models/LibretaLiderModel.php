<?php

    class LibretaLiderModel extends Mysql
    {
        private $srtFecha;
        private $strEvento;
        private $intColaboradorid;
        private $intStatusLider;


        public function __construct()
        {
            parent::__construct();
        }


        public function selectCols()
        {
            $this->intIdSuperior = $_SESSION['idUser'];
         
            $sql = "SELECT * FROM persona WHERE status !=0 AND superiorid = $this->intIdSuperior";
            $request = $this->select_all($sql);
            return $request;
        }

        
        public function insertEvento(int $intLiderid,string $srtFecha,string $strEvento,int $intColaboradorid, int $intStatusLider)
        {

            $this->intLiderid = $intLiderid;
            $this->strFecha = $srtFecha;
            $this->strEvento = $strEvento;
            $this->intColaboradorid = $intColaboradorid;
            $this->intStatusLider = $intStatusLider;
         

            $query_insert = "INSERT INTO libretalider(
                        liderid,colaboradorid,fecha,evento,tipoevento) VALUES (?,?,?,?,?)";

            $arrData = array(
                        $this->intLiderid,
                        $this->intColaboradorid,
                        $this->strFecha,
                        $this->strEvento,
                        $this->intStatusLider);

            $request_insert = $this->insert($query_insert,$arrData);
            return $request_insert;

        }

        public function updateEvento(int $intLiderid, int $idLibreta,string $srtFecha,string $strEvento,int $intColaboradorid, int $intStatusLider)
        {
            $this->intLiderid = $intLiderid;
            $this->intidLibreta = $idLibreta;
            $this->strFecha = $srtFecha;
            $this->strEvento = $strEvento;
            $this->intColaboradorid = $intColaboradorid;
            $this->intStatusLider = $intStatusLider;
         

            $query = "UPDATE libretalider SET liderid=?,colaboradorid=?,fecha=?,evento=?,tipoevento=?
                            WHERE idlibreta = $this->intidLibreta";

            $arrData = array(
                        $this->intLiderid,
                        $this->intColaboradorid,
                        $this->strFecha,
                        $this->strEvento,
                        $this->intStatusLider);

            $request = $this->update($query,$arrData);
            return $request;

        }




        public function selectEventos(){
            
            $this->intIdUser = $_SESSION['idUser'];
           

            $sql = "SELECT  l.idlibreta,l.colaboradorid ,l.evento,l.tipoevento,l.status, DATE_FORMAT(l.fecha , '%d/%m/%Y') as fechaEvento,p.idpersona,p.nombre, p.apellidos, p.superiorid
                    FROM libretalider l
                    INNER JOIN persona p
                    ON l.colaboradorid = p.idpersona
                    WHERE l.status !=0 AND p.superiorid = '{$this->intIdUser}'";

                    $request = $this->select_all($sql);
                    return $request;

        }


        public function selectEvento(int $idlibreta)
        {
            $this->intIdEvento = $idlibreta;

            $sql = "SELECT  l.idlibreta,l.liderid,l.colaboradorid,l.evento,l.tipoevento,l.status,p.idpersona,p.nombre,p.apellidos, l.fecha as fechaEvento
                    FROM libretalider l
                    INNER JOIN persona p
                    ON l.colaboradorid = p.idpersona
                    WHERE l.idlibreta = '{$this->intIdEvento}'";
                    $request = $this->select($sql);
                    return $request;
        }


        public function deleteEvento(int $idlibreta){

            $this->intIdlibreta = $idlibreta;


                $sql = "UPDATE libretalider SET status =? WHERE idlibreta=$this->intIdlibreta";
                $arrData = array(0);
                $request = $this->update($sql,$arrData);
                if($request)
                {
                    $request='ok';
                }else{
                    $request='error';
                }
        
            return $request;

        }


        ///MODELO INDICADORES LIBRETA LIDER


        public function selectIndEventos(string $fechaInicio,string $fechaFin){

            
            $this->intIdUser = $_SESSION['idUser'];
            $this->fechaInicio =$fechaInicio;
            $this->fechaFin =$fechaFin;

            $dateRange="";
            if($fechaInicio !="" AND $fechaFin !="")
            {
                $dateRange = " AND l.fecha BETWEEN '$this->fechaInicio' AND '$this->fechaFin'";
            }


            $sql="SELECT p.idpersona,p.nombre, p.apellidos,
            CONCAT(p.nombre, ' ', p.apellidos) as nombreCompleto,
            COUNT(case when l.tipoevento = 1 then 1 end) as pos,
            COUNT(case when l.tipoevento = 2 then 1 end) as neg,
            COUNT(case when l.tipoevento = 1 or l.tipoevento = 2 then 1 end) as total
            FROM libretalider l
            INNER JOIN persona p
            ON l.colaboradorid = p.idpersona
            WHERE l.status !=0 AND p.superiorid = '{$this->intIdUser}'$dateRange 
            GROUP BY l.colaboradorid";


                    $request = $this->select_all($sql);

                    return $request;

        }

        public function selectIndEventosFechas(){

            $this->intIdUser = $_SESSION['idUser'];


            $sql="SELECT DATE_FORMAT(MIN(l.fecha) , '%d/%m/%Y') as fechaMin, DATE_FORMAT(MAX(l.fecha) , '%d/%m/%Y') as fechaMax
            FROM libretalider l
            INNER JOIN persona p
            ON l.colaboradorid = p.idpersona
            WHERE l.status !=0 AND p.superiorid = '{$this->intIdUser}'";


                    $request = $this->select_all($sql);

                    return $request;

        }

       



    }//fin class


?>