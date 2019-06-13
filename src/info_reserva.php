<?php
include_once('classMysql.php');
$base = new bd_mysql;
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

//INTEGRANTES
$nombres_apellidos = $_SESSION['nom_ape'];
$cantCodigos = $_SESSION['cantCod'];
$codigos = $_SESSION['codigos'];

$fecha = date('Y-m-d');
$_SESSION['fecha']=$fecha;
//var_dump("capacidad: ".$capacidad,"hora inicio: ".$hora_inicio, "hora-fin: ".$hora_fin, "cubiculo: ".$cubiculo);

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

<div class="container my-4 ">
    <div class="row justify-content-center">
        <div class="col-12 mb-3 text-center">
            <h4>Información de la reserva</h4>
            <hr/>
        </div>
        <div class="card shadow p-4">
            <form action="grabar_reserva.php" method="post">

                Capacidad: <input type='text' value='<?= $capacidad ?>' name="txtCapacidad" style="border:0;" readonly/><br>
                Fecha: <input type='text' value='<?= $fecha ?>' name="txtFecha" style="border:0;"  readonly/><br>
                Cubiculo: <input type='text' value='<?= $cubiculo ?>'  name="txtCubiculo" style="border:0;"  readonly/><br>
                Hora Inicio: <input type='text' value='<?= $hora_inicio ?>' name="txtHI" style="border:0;"  readonly/><br>
                Hora Fin: <input type='text' value='<?= $hora_fin ?>'  name="txtHF" style="border:0;" readonly/><br>

                Integrantes:<br>
                <?= $cod ?> - <?= $usu ?><br>

                <div class="d-flex justify-content-center">
                <input class="btn btn-danger mt-3" type="submit" name="confirmar" value="Reservar"/>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="../node_modules/jquery/dist/jquery.min.js"></script>
<script src="../node_modules/popper.js/dist/popper.min.js"></script>
<script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="../node_modules/moment/min/moment.min.js"></script>
<script src="../node_modules/moment/locale/es-us.js"></script>
<script src="js/reservas.js"></script>
</body>

</html>