<?php
include_once("../../funciones/base_datos.php");

$cod=$_REQUEST['codCliente'];
$conexion=conectar();

$sql="SELECT * FROM clientes WHERE idCliente = :cod";
$sentencia = $conexion->prepare($sql);
$sentencia->execute([":cod" => $cod]);
$clientes = $sentencia->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($clientes);