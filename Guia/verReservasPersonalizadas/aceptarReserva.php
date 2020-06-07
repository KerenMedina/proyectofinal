<?php
include_once("../../funciones/base_datos.php");
$conexion=conectar();

$idReserva=$_REQUEST['idReserva'];

$sentencia = $conexion->prepare("UPDATE reservapersonalizada SET estado = :estado
                                WHERE idReservaPersonalizada= :cod ");
$resultado = $sentencia->execute([":estado"=> "aceptado", ":cod"=>$idReserva]);

    
if($resultado === TRUE) $mensajes["aceptar"]=true;
else $mensajes["aceptar"]=false;

echo json_encode($mensajes);