<?php
include_once("../../funciones/base_datos.php");
$conexion=conectar();

$idHorario = $_REQUEST['idHorario'];


$sentencia = $conexion->prepare("DELETE FROM horarios WHERE idHorario = :idHorario");
$resultado = $sentencia->execute([":idHorario"=>$idHorario]);

    
if($resultado === TRUE) $mensajes["eliminar"]=true;
else $mensajes["eliminar"]=false;

echo json_encode($mensajes);