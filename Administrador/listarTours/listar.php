<?php
include_once("../../funciones/base_datos.php");

$cod=$_REQUEST['codtour'];
$conexion=conectar();

$sql="SELECT * FROM tour WHERE idTour = :cod";
$sentencia = $conexion->prepare($sql);
$sentencia->execute([":cod" => $cod]);
$tours = $sentencia->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($tours);