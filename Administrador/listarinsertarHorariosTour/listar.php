<?php
include_once("../../funciones/base_datos.php");

$cod=$_REQUEST['codTour'];
$conexion=conectar();

$sql="SELECT * FROM horarios WHERE idTour = :cod";
$sentencia = $conexion->prepare($sql);
$sentencia->execute([":cod" => $cod]);
$horarios = $sentencia->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($horarios);