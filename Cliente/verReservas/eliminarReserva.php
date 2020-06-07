<?php
include_once("../../funciones/base_datos.php");
$conexion=conectar();

$idReserva=$_REQUEST['idReserva'];

$sentencia = $conexion->prepare("DELETE FROM reservas WHERE idReserva = :idReserva");
$resultado = $sentencia->execute([":idReserva"=>$idReserva]);

    
if($resultado === TRUE) $mensajes["eliminar"]=true;
else $mensajes["eliminar"]=false;

echo json_encode($mensajes);