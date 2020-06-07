<?php
include_once("../../funciones/base_datos.php");

$cod=$_REQUEST['codGuia'];
$conexion=conectar();

$sql="SELECT * FROM guias WHERE idGuia = :cod";
$sentencia = $conexion->prepare($sql);
$sentencia->execute([":cod" => $cod]);
$guias = $sentencia->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($guias);