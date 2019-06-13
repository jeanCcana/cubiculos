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

//RESERVA
$capacidad=$_SESSION["capacidad"];
$hora_inicio=$_SESSION["hora_inicio"];
$hora_fin=$_SESSION["hora_fin"];
$cubiculo=$_SESSION['cubiculo'];

//INTEGRANTES
$codigos=$_POST['codigos'];
$cantCodigos=count($codigos);

//var_dump("capacidad: ".$capacidad,"hora inicio: ".$hora_inicio, "hora-fin: ".$hora_fin, "cubiculo: ".$cubiculo);


for($i=0;$i<$capacidad-1;$i++){
	$codInt=$codigos[$i];
	$sql="select codigo_alumno,CONCAT(nombre,' ',apellido_paterno,' ',apellido_materno) as nom_ape,correo,clave from alumnos where codigo_alumno='$codInt'";
	$integrantes=$base->consultar($sql);
//	var_dump($integrantes);

	$codObt=$integrantes[0]['codigo_alumno'];

	$nom_ape=$integrantes[0]['nom_ape'];

	if($integrantes){
		header('location: info_reserva.php');
		$_SESSION['cantCod']=$cantCodigos;
		$_SESSION['nom_ape']=$nombres_apellidos;
		$_SESSION['codigos']=$codigos;
	}else{
		header('location: ingresar_datos.php');
	}
}


	


?>