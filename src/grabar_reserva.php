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
	echo "Cubículo reservado<br>";
	echo "<a href='reserva.php'>Inicio</a>";
}
?>