<?php
include_once("../../funciones/base_datos.php");
$conexion=conectar();

$titulo=$_REQUEST['titulo'];
$descripcion=$_REQUEST['descripcion'];
$precio=$_REQUEST['precio'];


$sentencia = $conexion->prepare("INSERT INTO tour(titulo, descripcion, precio)
                                 VALUES (:titulo, :descripcion, :precio );");
$resultado = $sentencia->execute([":titulo"=>$titulo, ":descripcion"=>$descripcion, ":precio"=>$precio]);

$idGuia = $_REQUEST['idGuia'];
$idTour= $conexion->lastInsertId();

$sentencia = $conexion->prepare("INSERT INTO tourGuia(idTour, idGuia)
                                 VALUES (:idTour, :idGuia);");
$resultado = $sentencia->execute(["idTour" => $idTour, ":idGuia" => $idGuia]);
    
if($resultado === TRUE) $mensajes["insertar"]=true;
else $mensajes["insertar"]=false;

echo json_encode($mensajes);