<?php

    class LoginModel extends Mysql
    {

        private $intIdUsuario;
        private $strUsuario;
        private $strPassword;




        public function __construct()
        {
            parent::__construct();
        }


        public function loginUser(string $usuario, string $password)
        {
            $this->strUsuario = $usuario;
            $this->strPassword = $password;
           $sql = "SELECT idpersona, status FROM persona WHERE
                    email = '$this->strUsuario' AND
                    password = '$this->strPassword' AND
                    status != 0 ";
                    
            $request = $this->select($sql);
            return $request;

        }

        public function sessionLogin(int $iduser)
        {

            $this->intIdUsuario = $iduser;

            $sql = "SELECT  p.idpersona,
                            p.nombre,
                            p.apellidos,
                            p.status,
                            p.user,
                            p.email,
                            p.departamento,
                            DATE_FORMAT(p.fechareg, '%d-%m-%Y') as fechaRegistro,
                            avatar,
                            r.idrol,
                            r.nombrerol
            FROM persona p
            INNER JOIN rol r
            ON p.rolid=r.idrol
            WHERE p.idpersona = $this->intIdUsuario";
            $request = $this->select($sql);
            $_SESSION['userData'] = $request;
            return $request;

        }

        public function getUserEmail(string $strEmail){
            $this->strUsuario = $strEmail;
            $sql = "SELECT idpersona, nombre, apellidos,status FROM persona WHERE
            email = '$this->strUsuario' AND status = 1";
            $request = $this->select($sql);
            return $request;
        }

        public function getUsuario(string $email){
            $this->strUsuario = $email;
            $sql = "SELECT idpersona FROM persona WHERE
            email = '$this->strUsuario' AND status = 1";
            $request = $this->select($sql);
            return $request;
        }

        public function insertPassword(int $idPersona, string $password){
            $this->intIdUsuario = $idPersona;
            $this->strPassword = $password;
            $sql = "UPDATE persona SET password = ? WHERE idpersona = $this->intIdUsuario";
            $arrData = array($this->strPassword);
            $request = $this->update($sql, $arrData);
            return $request;

        }

    }// fin class
?>