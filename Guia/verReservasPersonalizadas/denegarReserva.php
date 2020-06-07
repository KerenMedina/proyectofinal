<?php
include_once("../../funciones/base_datos.php");
$conexion=conectar();

$idReserva=$_REQUEST['idReserva'];

$sentencia = $conexion->prepare("DELETE FROM reservapersonalizada WHERE idReservaPersonalizada = :idReserva");
$resultado = $sentencia->execute([":idReserva"=>$idReserva]);

    
if($resultado === TRUE) $mensajes["denegar"]=true;
else $mensajes["denegar"]=false;

echo json_encode($mensajes);