<?php
include_once("../../funciones/base_datos.php");

$conexion=conectar();

$sql="SELECT * FROM guias";
$sentencia = $conexion->prepare($sql);
$sentencia->execute();
$guias = $sentencia->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($guias);