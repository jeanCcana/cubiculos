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

$capacidad = $_GET['cap'];
$hora_inicio = $_GET['hI'];
$hora_fin = $_GET['hF'];
$cubiculo = $_GET['cub'];

$_SESSION["capacidad"] = $capacidad;
$_SESSION["hora_inicio"] = $hora_inicio;
$_SESSION["hora_fin"] = $hora_fin;
$_SESSION['cubiculo'] = $cubiculo;


//var_dump("capacidad: ".$capacidad,"hora inicio: ".$hora_inicio, "hora-fin: ".$hora_fin, "cubiculo: ".$cubiculo);

$input = "<input type='text' name='codigos[]' required/><br>";

if ($tipo_usuario == 'administrador') {
    $titulo = "Ingresar codigos de los alumnos";
} else {
    $titulo = "Ingresar codigos";
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
        <a href="reserva.php" class="navbar-brand">
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
                    <a href="reserva.php" class="nav-link">Reservar</a>
                </li>
                <li class="nav-item">
                    <a href="lista_reservas.php" class="nav-link">Ver reservas</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown"
                       href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <?= $usu . "-" . $tipo_usuario ?></a>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="../">Salir</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container my-4 ">
    <div class="row justify-content-center">
        <div class="col-12 mb-3 text-center">
            <h4><?= $titulo ?></h4>
            <hr/>
        </div>
        <div>
            <form action="validar_datos.php" method="post">
                <?php if ($tipo_usuario == 'administrador') { ?>
                    <?php for ($i = 0; $i < $capacidad; $i++) { ?>
                        <?= $input ?>
                    <?php } ?>
                    <input class="btn btn-danger mt-2" type="submit" name="enviar"/>
                <?php } else { ?>
                    <input type='text' value='<?= $cod ?>' readonly/><label><?= $usu ?></label><br>
                    <?php for ($i = 1; $i < $capacidad; $i++) { ?>
                        <?= $input ?>
                    <?php } ?>
                    <input class="btn btn-danger mt-3" type="submit" name="enviar"/>
                <?php } ?>
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