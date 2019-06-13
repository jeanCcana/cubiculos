<?php
/**
 * Created by PhpStorm.
 * User: Dayanna
 * Date: 9/06/2019
 * Time: 02:36
 */

include_once('classMysql.php');
$base=new bd_mysql;

if(isset($_GET['id_reserva'])){
    global $base;
    $id_reserva=$_GET['id_reserva'];
    $sql="UPDATE reservas SET reservas.estado='0' WHERE  id_reserva=$id_reserva";
    $datos=$base->ejecutar($sql);
    header('location: lista_reservas.php');
}
?>