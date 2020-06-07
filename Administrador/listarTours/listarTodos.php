<?php
include_once("../../funciones/base_datos.php");

$conexion=conectar();

$sql="SELECT * FROM tour";
$sentencia = $conexion->prepare($sql);
$sentencia->execute();
$tours = $sentencia->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($tours);