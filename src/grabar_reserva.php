<?php
include_once('classMysql.php');
$base=new bd_mysql;
session_start();
//USUARIO
$correo = $_SESSION["correo"];
$clave = $_SESSION["clave"];
$usu = $_SESSION["usu"];
$cod = $_SESSION["cod"];
$tipo_usuario = $_SESSION["tipo_usuario"];


//RESERVA
$capacidad=$_SESSION["capacidad"];
$hora_inicio=$_SESSION["hora_inicio"];
$hora_fin=$_SESSION["hora_fin"];
$cubiculo=$_SESSION['cubiculo'];
$fecha=$_SESSION['fecha'];

$h_i = $fecha." ".date('H:i:s ', strtotime($hora_inicio));
$h_f = $fecha." ".date('H:i:s ', strtotime($hora_fin));


$sql = "INSERT INTO reservas (hora_inicio,hora_fin,id_cubiculo) VALUES ('$h_i','$h_f','$cubiculo')";
$datos=$base->ejecutar($sql);
$cnx=$base->cnx;
$ultimoId=mysqli_insert_id($cnx);

$sql2="INSERT INTO alumnos_reservas (id_reserva,codigo_alumno) VALUES ('$ultimoId','$cod')";

$datos1=$base->ejecutar($sql2);

if ($datos1){
	echo '<div class="container my-4 ">
    <div class="row justify-content-center">
        <div class="col-12 text-center">
            <h4>Cubiculo Reservado</h4>
            <a href="reserva.php">Inicio</a>
        </div>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <link rel="icon" type="image/png" href="img/logo.ico"/>
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/general.css"/>
    <link rel="stylesheet" href="css/cubiculos.css"/>
    <title>USMP - Reserva de Cubiculos</title>
</head>

<body>
<nav class="navbar navbar-dark gradient shadow navbar-expand-sm fixed-top">
    <div class="container">
        <a href="#" class="navbar-brand">
            <img id="logo" height="40px" src="img/logo_fia_nav.png"/>
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#menu"
                aria-controls="menu-principal" aria-expanded="false" aria-label="Desplegar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="menu" class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <!-- <li class="nav-item"> <a href="index.php" class="nav-link">Iinicio</a> </li> -->
                <li class="nav-item active">
                    <a href="reserva.php" class="nav-link">Hacer reserva</a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link">Cancelar reserva</a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link"><?= $usu . "-" . $tipo_usuario ?></a>
                </li>
            </ul>
        </div>
    </div>
</nav>




<script src="../node_modules/jquery/dist/jquery.min.js"></script>
<script src="../node_modules/popper.js/dist/popper.min.js"></script>
<script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="../node_modules/moment/min/moment.min.js"></script>
<script src="../node_modules/moment/locale/es-us.js"></script>
<script src="js/reservas.js"></script>
</body>

</html>