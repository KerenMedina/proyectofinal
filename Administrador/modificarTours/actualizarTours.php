<?php
include_once("../../funciones/base_datos.php");
$conexion=conectar();

$cod=$_REQUEST['codigo'];
$titulo=$_REQUEST['titulo'];
$descripcion=$_REQUEST['descripcion'];
$precio=$_REQUEST['precio'];



$sentencia = $conexion->prepare("UPDATE tour SET titulo = :titulo, precio = :precio,
                                descripcion = :descripcion WHERE idTour= :cod ");
$resultado = $sentencia->execute([":descripcion"=>$descripcion, ":titulo"=>$titulo, ":precio"=>$precio,
                                ":cod"=>$cod]);

    
if($resultado === TRUE) $mensajes["actualizar"]=true;
else $mensajes["actualizar"]=false;

echo json_encode($mensajes);