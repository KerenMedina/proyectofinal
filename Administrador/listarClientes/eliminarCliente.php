<?php
include_once("../../funciones/base_datos.php");
$conexion=conectar();

$idCliente=$_REQUEST['idCliente'];

$sentencia = $conexion->prepare("DELETE FROM clientes WHERE idCliente = :idCliente");
$resultado = $sentencia->execute([":idCliente"=>$idCliente]);

    
if($resultado === TRUE) $mensajes["eliminar"]=true;
else $mensajes["eliminar"]=false;

echo json_encode($mensajes);