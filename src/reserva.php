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
//
if (isset($_POST['btnBuscar'])) {
    $capacidad = $_POST['inputCapacidad'];
    $hora_inicio = $_POST['inputHoraInicio'];
    $hora_fin = $_POST['inputHoraFinal'];
//$capacidad = '3';
//$hora_inicio = '08:00 AM';
//$hora_fin = '10:30 AM';
    $h_i = date('Y-m-d H:i:s', strtotime($hora_inicio));
    $h_f = date('Y-m-d H:i:s', strtotime($hora_fin));

    $sql = "select reservas.id_cubiculo from reservas,cubiculos  WHERE (('$h_i' BETWEEN reservas.hora_inicio AND reservas.hora_fin) OR ('$h_f' BETWEEN reservas.hora_inicio AND reservas.hora_fin)) AND reservas.id_cubiculo=cubiculos.id_cubiculo AND cubiculos.capacidad=$capacidad";

    $datos = $base->consultar($sql);
    $cantRes = count($datos);
    $pagina = "ingresar_datos.php?cap=$capacidad&&hI=$hora_inicio&&hF=$hora_fin&&cub=";
    $cub = [1 => "disp", 2 => "disp", 3 => "disp", 4 => "disp", 5 => "disp", 6 => "disp", 7 => "disp"];
    $pag = [1 => $pagina . "1", 2 => $pagina . "2", 3 => $pagina . "3", 4 => $pagina . "4", 5 => $pagina . "5", 6 => $pagina . "6", 7 => $pagina . "7"];
    for ($i = 0; $i < $cantRes; $i++) {
        for ($n = 1; $n < 8; $n++) {
            if ($datos[$i]['id_cubiculo'] == $n) {
                $cub[$n] = "noDisp";
                $pag[$n] = "#";

            }
        }
    }
    if ($capacidad == '3') {
        $cub[1] = "noPermt";
        $cub[2] = "noPermt";
        $cub[7] = "noPermt";
        $pag[1] = "#";
        $pag[2] = "#";
        $pag[7] = "#";

    } else {
        $cub[3] = "noPermt";
        $cub[4] = "noPermt";
        $cub[5] = "noPermt";
        $cub[6] = "noPermt";
        $pag[3] = "#";
        $pag[4] = "#";
        $pag[5] = "#";
        $pag[6] = "#";
    }

//    var_dump($capacidad, $h_i, $h_f);
} else {
    $pagina = "#";
    $cub = [1 => "noDisp", 2 => "noDisp", 3 => "noDisp", 4 => "noDisp", 5 => "noDisp", 6 => "noDisp", 7 => "noDisp"];
    $pag = [1 => $pagina, 2 => $pagina, 3 => $pagina, 4 => $pagina, 5 => $pagina, 6 => $pagina, 7 => $pagina];
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
<nav class="navbar navbar-dark gradient shadow navbar-expand-md fixed-top">
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
        <div class="col-12 text-center">
            <h4>Haz tu reserva</h4>
            <hr/>
        </div>

        <div class="col-auto">
            <div class="dropdown">
            <span class="mr-">Capacidad:
            </span>
                <button class="btn btn-light border dropdown-toggle" type="button" id="btnCapa" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">3</button>
                <div id="dropCapa" name="cboCapacidad" class="dropdown-menu" aria-labelledby="btnCapa">
                    <a class="dropdown-item" href="#">3</a>
                    <a class="dropdown-item" href="#">4</a>
                </div>
            </div>
        </div>

        <div class="col-auto">
            <div class="dropdown">
            <span>Inicio:
            </span>
                <button class="btn btn-light border dropdown-toggle" type="button" id="btnHoraIn"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">08:00 am</button>
                <div id="dropHoraIn" name="cboInicio" class="dropdown-menu scrollable-menu"
                     aria-labelledby="btnHoraIn">
                    <a class="dropdown-item" href="#">10:00 am</a>
                    <a class="dropdown-item" href="#">10:30 am</a>
                </div>
            </div>
        </div>

        <div class="col-auto">
            <div class="dropdown">
            <span>Fin:
            </span>
                <button class="btn btn-light border dropdown-toggle" type="button" id="btnHoraFin"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">.......</button>
                <div id="dropHoraFin" name="cboFin" class="dropdown-menu" aria-labelledby="btnHoraFin">
                    <a class="dropdown-item" href="#">10:00 am</a>
                    <a class="dropdown-item" href="#">10:30 am</a>
                </div>
            </div>
        </div>

        <div class="col-12 justify-content-center d-flex mt-3">
          <form name="formBuscar" action="reserva.php#" method="post">
            <input id="inputCapacidad" name="inputCapacidad" type="hidden">
            <input id="inputHoraInicio" name="inputHoraInicio" type="hidden">
            <input id="inputHoraFinal" name="inputHoraFinal" type="hidden">
            <input class="btn btn-danger" id="btnBuscar" value="Buscar" type="submit" name="btnBuscar">
          </form>
        </div>

        <div class="col-12 mt-3">
            <center>
                <table>
                    <!--Fila1-->
                    <tr>
                        <td class="cubiculo <?php echo $cub[1]; ?>">
                            <img class="p90" src="img/mesa4.png"/>
                            <span class="indCubi">
                                <a href="<?= $pag[1] ?>">1</a>
                            </span>
                        </td>
                        <td class="cubiculo <?php echo $cub[2]; ?>">
                            <img class="p90" src="img/mesa4.png"/>
                            <span class="indCubi">
                                <a href="<?= $pag[2] ?>">2</a>
                            </span>
                        </td>
                    </tr>
                    <!--Fila2-->
                    <tr class="border-top border-left border-dark m">
                        <td>
                            <img class="p0" src="img/mesa4.png"/>
                        </td>
                        <td>
                            <img class="p0" src="img/mesa4.png"/>
                        </td>
                        <td>
                            <div class="p0"></div>
                        </td>
                        <td>
                            <img class="p90" src="img/mesa4.png"/>
                        </td>
                        <td>
                            <img class="p90" src="img/mesa4.png"/>
                        </td>
                        <td>
                            <img class="p90" src="img/mesa4.png"/>
                        </td>
                        <td>
                            <img class="p90" src="img/mesa4.png"/>
                        </td>
                        <td>
                            <img class="p90" src="img/mesa2.png"/>
                        </td>
                        <td class="cubiculo <?php echo $cub[3]; ?>">
                            <img class="p0" src="img/mesa3.png"/>
                            <span class="indCubi">
                                <a href="<?= $pag[3] ?>">3</a>
                            </span>
                        </td>
                    </tr>
                    <!--Fila3-->
                    <tr class="border-left border-dark m">
                        <td>
                            <img class="p0" src="img/mesa4.png"/>
                        </td>
                        <td>
                            <img class="p0" src="img/mesa4.png"/>
                        </td>
                        <td>
                            <div class="p0"></div>
                        </td>
                        <td>
                            <img class="p90" src="img/mesa4.png"/>
                        </td>
                        <td>
                            <img class="p90" src="img/mesa4.png"/>
                        </td>
                        <td>
                            <img class="p90" src="img/mesa4.png"/>
                        </td>
                        <td>
                            <img class="p90" src="img/mesa4.png"/>
                        </td>
                        <td>
                            <img class="p0" src="img/mesa2.png"/>
                        </td>
                        <td class="cubiculo <?php echo $cub[4]; ?>">
                            <img class="p180" src="img/mesa3.png"/>
                            <span class="indCubi">
                                <a href="<?= $pag[4] ?>">4</a>
                            </span>
                        </td>
                    </tr>
                    <!--Fila4-->
                    <tr class="border-left border-dark m">
                        <td>
                            <img class="p0" src="img/mesa4.png"/>
                        </td>
                        <td>
                            <img class="p0" src="img/mesa4.png"/>
                        </td>
                        <td>
                            <div class="p0"></div>
                        </td>
                        <td>
                            <img class="p90" src="img/mesa4.png"/>
                        </td>
                        <td>
                            <img class="p90" src="img/mesa4.png"/>
                        </td>
                        <td>
                            <img class="p90" src="img/mesa4.png"/>
                        </td>
                        <td>
                            <img class="p90" src="img/mesa3.png"/>
                        </td>
                        <td>
                            <img class="p90" src="img/mesa2.png"/>
                        </td>
                        <td class="cubiculo <?php echo $cub[5]; ?>">
                            <img class="p180" src="img/mesa3.png"/>
                            <span class="indCubi">
                                <a href="<?= $pag[5] ?>">5</a>
                            </span>
                        </td>
                    </tr>
                    <!--Fila5-->
                    <tr>
                        <td clas="clas">
                            <div class="pv border-left border-bottom border-dark m"></div>
                        </td>
                        <td>
                            <div class="pv border-bottom border-dark m"></div>
                        </td>
                        <td>
                            <div class="pv border-bottom border-dark m"></div>
                        </td>
                        <td>
                            <div class="pv border-bottom border-dark m"></div>
                        </td>
                        <td>
                            <div class="pv border-bottom border-dark m"></div>
                        </td>
                        <td>
                            <div class="pv border-bottom border-dark m"></div>
                        </td>
                        <td>
                            <div class="pv border-bottom border-dark m"></div>
                        </td>
                        <td style="vertical-align: bottom" class="m">
                            <div class="pv border-left border-dark"></div>
                        </td>
                        <td class="cubiculo <?php echo $cub[6]; ?>">
                            <img class="p0" src="img/mesa3.png"/>
                            <span class="indCubi">
                                <a href="<?= $pag[6] ?>">6</a>
                            </span>
                        </td>
                    </tr>
                    <!--Fila6-->
                    <tr>
                        <td>
                            <div class="p0"></div>
                        </td>
                        <td>
                            <div class="p0"></div>
                        </td>
                        <td>
                            <div class="p0"></div>
                        </td>
                        <td>
                            <div class="p0"></div>
                        </td>
                        <td>
                            <div class="p0"></div>
                        </td>
                        <td>
                            <div class="p0"></div>
                        </td>
                        <td>
                            <div class="p0"></div>
                        </td>
                        <td class=" border-left border-bottom border-dark m">
                            <div class="p0"></div>
                        </td>
                        <td class="cubiculo <?php echo $cub[7]; ?>">
                            <img class="p0" src="img/mesa4.png"/>
                            <span class="indCubi">
                                <a href="<?= $pag[7] ?>">7</a>
                            </span>
                        </td>

                    </tr>
                </table>
            </center>
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