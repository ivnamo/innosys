<?php
    class Mysql extends Conexion
    {
        private $conexion;
        private $strquery;
        private $arrValues;

        function __construct()
        {
            $this->conexion = new Conexion();
            $this->conexion = $this->conexion->conect();
           
        }

        //Insertar registro
        public function insert(string $query, array $arrValues)
        {
            $this->strquery = $query;
            $this->arrVAlues = $arrValues;
            $insert = $this->conexion->prepare($this->strquery);
            //echo "inserto cosas";
            $resInsert = $insert->execute($this->arrVAlues);
            if($resInsert)
            {
                $lastInsert = $this->conexion->lastInsertId();
            }else{
               $lastInsert = e;
            }
            return $lastInsert;
        }
        
        //Buscar registro
        public function select(string $query)
        {
            $this->strquery = $query;
            $result = $this->conexion->prepare($this->strquery);
            $result -> execute();
            $data = $result->fetch(PDO::FETCH_ASSOC);
            return $data;
        }
        
        //Todos los registros
        public function select_all(string $query)
        {
            $this->strquery = $query;
            $result = $this->conexion->prepare($this->strquery);
            $result->execute();
            $data = $result->fetchall(PDO::FETCH_ASSOC);
            return $data;

        }

         //Actualizar registros
         public function update(string $query, array $arrvalues)
         {
             $this->strquery = $query;
             $this->arrvalues = $arrvalues;
             $update = $this->conexion->prepare($this->strquery);
             $resExecute = $update->execute($this->arrvalues);
             return $resExecute;
 
         }

        //Eliminar un registros
        public function delete(string $query)
        {
            $this->strquery = $query;
            $result = $this->conexion->prepare($this->strquery);
            $result->execute();
            return $result;

        }
    }




?>