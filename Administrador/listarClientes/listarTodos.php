<?php
include_once("../../funciones/base_datos.php");

$conexion=conectar();

$sql="SELECT * FROM clientes";
$sentencia = $conexion->prepare($sql);
$sentencia->execute();
$clientes = $sentencia->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($clientes);