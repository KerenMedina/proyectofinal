<?php
include_once("../../funciones/base_datos.php");
$conexion=conectar();

$idGuia=$_REQUEST['idGuia'];

$sentencia = $conexion->prepare("DELETE FROM guias WHERE idGuia = :idGuia");
$resultado = $sentencia->execute([":idGuia"=>$idGuia]);

    
if($resultado === TRUE) $mensajes["eliminar"]=true;
else $mensajes["eliminar"]=false;

echo json_encode($mensajes);