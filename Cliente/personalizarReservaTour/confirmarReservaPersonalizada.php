<?php
include_once("../../funciones/base_datos.php");
$conexion=conectar();

$idCliente=$_REQUEST['idCliente'];
$idTour=$_REQUEST['idTour'];
$idGuia=$_REQUEST['idGuia'];
$horario=$_REQUEST['horario'];
$idioma=$_REQUEST['idioma'];
$estado = "espera";

$horario = str_replace('T', ' ', $horario);
$horario = date_create($horario);
$horario = date_format($horario, 'Y-m-d H:i:s'); 



$sentencia = $conexion->prepare("INSERT INTO reservaPersonalizada(idCliente, idTour, idGuia, horario, idioma, estado)
                                 VALUES (:idCliente, :idTour, :idGuia, :horario, :idioma, :estado);");
$resultado = $sentencia->execute([":idCliente"=>$idCliente, ":idTour"=>$idTour, ":idGuia"=>$idGuia,
                                  ":horario"=>$horario, ":idioma" => $idioma, ":estado" => $estado]);

    
if($resultado === TRUE) $mensajes["insertar"]=true;
else $mensajes["insertar"]=false;

echo json_encode($mensajes);