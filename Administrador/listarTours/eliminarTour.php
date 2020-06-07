<?php
include_once("../../funciones/base_datos.php");
$conexion=conectar();

$idTour=$_REQUEST['idTour'];

$sentencia = $conexion->prepare("DELETE FROM tour WHERE idTour = :idTour");
$resultado = $sentencia->execute([":idTour"=>$idTour]);

    
if($resultado === TRUE) $mensajes["eliminar"]=true;
else $mensajes["eliminar"]=false;

echo json_encode($mensajes);