<?php

include_once('classMysql.php');
ini_set('display_errors', 1);

$base = new bd_mysql;

if (isset($_POST['btnIngresar'])) {
    $correo = $_POST['txtCorreo'];
    $clave = $_POST['txtClave'];

    $sql = "select codigo_alumno,CONCAT(nombre,' ',apellido_paterno,' ',apellido_materno) as nom_ape,correo,clave,tipo_usuario,estado from alumnos where correo='$correo' && clave='$clave'";

    $datos = $base->consultar($sql);
    if ($datos) {
        $usuario = $datos[0]['nom_ape'];
        $codigo = $datos[0]['codigo_alumno'];
        $tipo_usuario = $datos[0]['tipo_usuario'];
        $estado = $datos[0]['estado'];
//        var_dump($usuario, $codigo, $tipo_usuario, $estado);
        if ($estado == "habilitado") {
            session_start();
            $_SESSION['acceso'] = 'concedido';
            $_SESSION["correo"] = $correo;
            $_SESSION["clave"] = $clave;
            $_SESSION["usu"] = $usuario;
            $_SESSION["cod"] = $codigo;
            $_SESSION["tipo_usuario"] = $tipo_usuario;
            header('location: reserva.php');
        } else {
            session_start();
            session_destroy();
            $msj = "Usuario inhabilitado";
            header('location: index.php');
        }
    } else {
        session_start();
        session_destroy();
        $msj = "Usuario o clave incorrecto";
        header('location: index.php');
    }
}

?>