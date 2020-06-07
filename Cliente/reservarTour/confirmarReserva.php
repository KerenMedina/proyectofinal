<?php
include_once("../../funciones/base_datos.php");
$conexion=conectar();

$idCliente=$_REQUEST['idCliente'];
$idTour=$_REQUEST['idTour'];
$idGuia=$_REQUEST['idGuia'];
$idHorario=$_REQUEST['idHorario'];



$sentencia = $conexion->prepare("INSERT INTO reservas(idCliente, idTour, idGuia, idHorario)
                                 VALUES (:idCliente, :idTour, :idGuia, :idHorario);");
$resultado = $sentencia->execute([":idCliente"=>$idCliente, ":idTour"=>$idTour, ":idGuia"=>$idGuia,
                                  ":idHorario"=>$idHorario]);

    
if($resultado === TRUE) $mensajes["insertar"]=true;
else $mensajes["insertar"]=false;

echo json_encode($mensajes);
