<?php

    class UsuariosModel extends Mysql
    {
        private $intIdUsuario;
        private $strNombre;
        private $strApellido;
        private $strPassword;
        private $intTipo;
        private $intStatus;
        private $strImagen;

        public function __construct()
        {
            parent::__construct();
        }

        public function insertUsuario(string $user,string $email,string $nombre, string $apellido, string $password, int $tipo, int $status)
        {

         $this->strUser = $user;
         $this->strEmail = $email;
         $this->strNombre = $nombre;
         $this->strApellido = $apellido;
         $this->strPassword = $password;
         $this->intTipo = $tipo;
         $this->intStatus = $status;
         $return =0;

         $sql = "SELECT * FROM persona WHERE
                email = '{$this->strEmail}'";
        
            $request = $this->select_all($sql);

                if(empty($request)){
                    $query_insert = "INSERT INTO persona(
                        nombre, apellidos, password,rolid,status,user,email) VALUES (?,?,?,?,?,?,?)";
                    $arrData = array(
                    $this->strNombre, 
                    $this->strApellido,
                    $this->strPassword,
                    $this->intTipo,
                    $this->intStatus, 
                    $this->strUser,
                    $this->strEmail);
                    $request_insert = $this->insert($query_insert,$arrData);
                    $return = $request_insert;

                    
                }else{
                    $return="exist";

                }
            
                return $return;

        }

        public function selectUsuarios()
        {

            $whereAdmin="";
            if($_SESSION['idUser']!=1)
            {
                $whereAdmin = " AND p.idpersona !=1";
            }

            $sql = "SELECT  p.idpersona,p.nombre,p.apellidos,p.status, DATE_FORMAT(p.fechareg, '%d-%m-%Y') as fechaRegistro,r.idrol,r.nombrerol
                    FROM persona p
                    INNER JOIN rol r
                    ON p.rolid = r.idrol
                    WHERE p.status !=0".$whereAdmin;

                    $request = $this->select_all($sql);
                    return $request;
        }



        public function selectUsuario(int $idpersona)
        {
            $this->intIdUsuario = $idpersona;

            $sql = "SELECT  p.idpersona,p.nombre,p.apellidos,p.status,p.user,p.email,r.idrol,r.nombrerol, DATE_FORMAT(p.fechareg, '%d-%m-%Y') as fechaRegistro
                    FROM persona p
                    INNER JOIN rol r
                    ON p.rolid = r.idrol
                    WHERE p.idpersona = '{$this->intIdUsuario}'";
                    $request = $this->select($sql);
                    return $request;
        }


        public function updateUsuario( int $idUsuario,string $user,string $email, string $nombre, string $apellido, string $password, int $tipoid, int $status)
        {
            $this->intIdUsuario = $idUsuario;
            $this->strUser = $user;
            $this->strEmail = $email;
            $this->strNombre = $nombre;
            $this->strApellido = $apellido;
            $this->strPassword = $password;
            $this->intTipo = $tipoid;
            $this->intStatus = $status;

            $sql = "SELECT * FROM persona WHERE (email = '{$this->strEmail}' AND idpersona != '{$this->intIdUsuario}')";
            $request = $this->select_all($sql);

            if(empty($request))
            {
                if($this->strPassword !="")
                {
                    $sql = "UPDATE persona SET nombre=?, apellidos=?,password=?,rolid=?, status=?,user=?,email=? 
                            WHERE idpersona = $this->intIdUsuario";
                    
                    $arrData = array($this->strNombre,
                    $this->strApellido,
                    $this->strPassword,
                    $this->intTipo,
                    $this->intStatus, 
                    $this->strUser,
                    $this->strEmail);
                }else{
                    $sql = "UPDATE persona SET nombre=?, apellidos=?,rolid=?, status=? ,user=?,email=?
                    WHERE idpersona = $this->intIdUsuario";
            
            $arrData = array($this->strNombre,
            $this->strApellido,
            $this->intTipo,
            $this->intStatus,
            $this->strUser,
            $this->strEmail);
                }
                $request=$this->update($sql,$arrData);

            }else{
                $request = "exist";
            }

            return $request;

        }


        public function deleteUsuario(int $intIdpersona)
        {
            $this->intIdUsuario = $intIdpersona;
            $sql = "UPDATE persona SET status = ? WHERE idpersona = $this->intIdUsuario";
            $arrData = array(0);
            $request = $this->update($sql,$arrData);
            return $request;


        }

        public function updatePerfil(int $idUsuario,string $user, string $nombre, string $apellido, string $password)
        {
            $this->intIdUsuario = $idUsuario;
            $this->strUser = $user;
            $this->strNombre = $nombre;
            $this->strApellido = $apellido;
            $this->strPassword = $password;

            if($this->strPassword !=""){
                $sql = "UPDATE persona SET nombre=?, apellidos=?,password=?,user=?
                WHERE idpersona = $this->intIdUsuario";

                $arrData = array($this->strNombre,
                $this->strApellido,
                $this->strPassword,
                $this->strUser
                );


            }else{
                $sql = "UPDATE persona SET nombre=?, apellidos=?,user=?
                WHERE idpersona = $this->intIdUsuario";

                $arrData = array($this->strNombre,
                $this->strApellido,
                $this->strUser
                );

            }
          
            $request = $this->update($sql,$arrData);
            return $request;


        }

        public function insertImage(int $idUsuario, string $imagen){
            $this->intIdUsuario = $idUsuario;
            $this->strImagen = $imagen;

            $sql = "UPDATE persona SET avatar=?
                WHERE idpersona = $this->intIdUsuario";

                $arrData = array($this->strImagen);
            
                $request = $this->update($sql,$arrData);
                return $request;
        }



       


    }//fin class


?>