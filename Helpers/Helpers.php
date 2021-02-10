<?php

    function base_url()
    {
        return BASE_URL;
    }


    function headerAdmin($data="")
    {
        $view_header = "Views/Template/header_admin.php";
        require_once($view_header);
    }

    function footerAdmin($data="")
    {
        $view_footer = "Views/Template/footer_admin.php";
        require_once($view_footer);
    }

    function headerFront($data="")
    {
        $view_header = "Views/Template/header_front.php";
        require_once($view_header);
    }

    function footerFront($data="")
    {
        $view_footer = "Views/Template/footer_front.php";
        require_once($view_footer);
    }


    function dep($data)
    {

        $format = print_r('<pre>');
        $format .= print_r($data);
        $format .= print_r('</pre>');
        return $format;

    }

    function getModal(string $nameModal, $data)
    {
        $view_modal = "Views/Template/Modals/{$nameModal}.php";
        require_once ($view_modal);


    }

    //Envio de correos
    function sendEmail($data,$template)
    {
        $asunto = $data['asunto'];
        $emailDestino = $data['email'];
        $empresa = NOMBRE_REMITENTE;
        $remitente = EMAIL_REMITENTE;
        //ENVIO DE CORREO
        $de = "MIME-Version: 1.0\r\n";
        $de .= "Content-type: text/html; charset=UTF-8\r\n";
        $de .= "From: {$empresa} <{$remitente}>\r\n";
        ob_start();
        require_once("Views/Template/Email/".$template.".php");
        $mensaje = ob_get_clean();
        $send = mail($emailDestino, $asunto, $mensaje, $de);
        return $send;
    }


    function getPermisos(int $idmodulo)
    {
        require_once("Models/PermisosModel.php");
        $objPermisos = new PermisosModel();
        $idrol = $_SESSION['userData']['idrol'];
        $arrPermisos = $objPermisos->permisosModulo($idrol);
        $permisos ="";
        $permisosMod="";
        if(count($arrPermisos)>0){
            $permisos = $arrPermisos;
            $permisosMod = isset($arrPermisos[$idmodulo]) ? $arrPermisos[$idmodulo]:"";
        }

        $_SESSION['permisos'] = $permisos;
        $_SESSION['permisosMod'] = $permisosMod;

    }

    function sessionUser(int $idpersona){
        require_once("Models/LoginModel.php");
        $objLogin = new LoginModel();
        $request = $objLogin->sessionLogin($idpersona);
        return $request;

    }

    function uploadImage(array $data, string $destino){
        $url_temp = $data['tmp_name'];
        $move = move_uploaded_file($url_temp,$destino);
        return $move;

         
    }


    //funcion limpieza string para evitar sql injection
    function strClean($strCadena){
        $string = preg_replace(['/\s+/','/^\s|\s$/'],[' ',''], $strCadena);
        $string = trim($string); //Elimina espacios en blanco al inicio y al final
        $string = stripslashes($string); // Elimina las \ invertidas
        $string = str_ireplace("<script>","",$string);
        $string = str_ireplace("</script>","",$string);
        $string = str_ireplace("<script src>","",$string);
        $string = str_ireplace("<script type=>","",$string);
        $string = str_ireplace("SELECT * FROM","",$string);
        $string = str_ireplace("DELETE FROM","",$string);
        $string = str_ireplace("INSERT INTO","",$string);
        $string = str_ireplace("SELECT COUNT(*) FROM","",$string);
        $string = str_ireplace("DROP TABLE","",$string);
        $string = str_ireplace("OR '1'='1","",$string);
        $string = str_ireplace('OR "1"="1"',"",$string);
        $string = str_ireplace('OR ´1´=´1´',"",$string);
        $string = str_ireplace("is NULL; --","",$string);
        $string = str_ireplace("is NULL; --","",$string);
        $string = str_ireplace("LIKE '","",$string);
        $string = str_ireplace('LIKE "',"",$string);
        $string = str_ireplace("LIKE ´","",$string);
        $string = str_ireplace("OR 'a'='a","",$string);
        $string = str_ireplace('OR "a"="a',"",$string);
        $string = str_ireplace("OR ´a´=´a","",$string);
        $string = str_ireplace("OR ´a´=´a","",$string);
        $string = str_ireplace("--","",$string);
        $string = str_ireplace("^","",$string);
        $string = str_ireplace("[","",$string);
        $string = str_ireplace("]","",$string);
        $string = str_ireplace("==","",$string);
        return $string;
    }

    function strCleanCom($strCadena){
        $string = preg_replace(['/\s+/','/^\s|\s$/'],[' ',''], $strCadena);
        $string = str_ireplace('"',"",$string);
        return $string;
    }



?>