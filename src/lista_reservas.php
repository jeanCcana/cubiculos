<?php
include_once('control.php');
include_once('classMysql.php');

$base = new bd_mysql;
//USUARIO
$correo = $_SESSION["correo"];
$clave = $_SESSION["clave"];
$usu = $_SESSION["usu"];
$cod = $_SESSION["cod"];
$tipo_usuario = $_SESSION["tipo_usuario"];

if ($tipo_usuario == "administrador") {
    $sql = "select CONCAT(alumnos.nombre,' ',alumnos.apellido_paterno,' ',alumnos.apellido_materno) as nom_ape,alumnos_reservas.codigo_alumno, SUBSTRING(hora_inicio,1,10) as dia,SUBSTRING(TIMEDIFF(hora_fin,hora_inicio),1,5) as duracion,reservas.id_reserva,SUBSTRING(hora_inicio,11,6) as hora_inicio,SUBSTRING(hora_fin,11,6) as hora_fin,id_cubiculo 
from alumnos_reservas join reservas on alumnos_reservas.id_reserva=reservas.id_reserva join alumnos on alumnos_reservas.codigo_alumno=alumnos.codigo_alumno where reservas.estado='1'";

} else {
    $sql = "select CONCAT(alumnos.nombre,' ',alumnos.apellido_paterno,' ',alumnos.apellido_materno) as nom_ape,alumnos_reservas.codigo_alumno, SUBSTRING(hora_inicio,1,10) as dia,SUBSTRING(TIMEDIFF(hora_fin,hora_inicio),1,5) as duracion,reservas.id_reserva,SUBSTRING(hora_inicio,11,6) as hora_inicio,SUBSTRING(hora_fin,11,6) as hora_fin,id_cubiculo 
from alumnos_reservas join reservas on alumnos_reservas.id_reserva=reservas.id_reserva join alumnos on alumnos_reservas.codigo_alumno=alumnos.codigo_alumno where alumnos_reservas.codigo_alumno=$cod &&  reservas.estado='1'";
}
$datos = $base->consultar($sql);


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <link rel="icon" type="image/png" href="img/logo.ico"/>
    <link rel="stylesheet" href="css/general.css"/>
    <link rel="stylesheet" href="css/cubiculos.css"/>
    <!--    Font Awesome 4 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="datatables/datatables.min.css"/>
    <!--datables estilo bootstrap 4 CSS-->
    <link rel="stylesheet" type="text/css" href="datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">

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
                <li class="nav-item">
                    <a href="reserva.php" class="nav-link">Reservar</a>
                </li>
                <li class="nav-item active">
                    <a href="lista_reservas.php" class="nav-link">Ver reservas</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown"
                       href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <?= $usu . "-" . $tipo_usuario ?></a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="index.php">Salir</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container my-4 ">
    <div class="row justify-content-center">
        <div class="col-12 mb-3 text-center">
            <h4>Reservas</h4>
            <hr/>
        </div>
        <div class="col-lg-12">
            <table id="dataTable" class="table table-striped table-hover table-bordered">
                <thead>
                <th>ID RESERVA</th>
                <th>CUBÍCULO</th>
                <th>HORA INICIO</th>
                <th>HORA FIN</th>
                <th>FECHA</th>
                <th>DURACIÓN</th>
                <th>ALUMNO</th>
                <th>ELIMINAR</th>
                </thead>
                <tbody>
                <?php foreach ($datos as $d) { ?>
                    <tr>
                        <td><?= $d['id_reserva'] ?></td>
                        <td><?= $d['id_cubiculo'] ?></td>
                        <td><?= $d['hora_inicio'] ?></td>
                        <td><?= $d['hora_fin'] ?></td>
                        <td><?= $d['dia'] ?></td>
                        <td><?= $d['duracion'] ?></td>
                        <td><?= $d['nom_ape'] ?></td>
                        <td><a href="cancelar_reserva.php?id_reserva=<?= $d['id_reserva'] ?>"><i class="fa fa-trash"
                                                                                                 style="font-size:30px;color:#c31432"></i></a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- jQuery, Popper.js, Bootstrap JS -->
<script src="jquery/jquery-3.3.1.min.js"></script>
<script src="popper/popper.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>

<!-- datatables JS -->
<script type="text/javascript" src="datatables/datatables.min.js"></script>

<script type="text/javascript" src="js/main.js"></script>


</body>
</html>
