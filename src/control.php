<?php
/**
 * Created by PhpStorm.
 * User: Dayanna
 * Date: 2/05/2019
 * Time: 02:29
 */
session_start();
if($_SESSION['acceso']<>'concedido'){
    header('location: info_reserva.php');
}
?>
