<?php
define("PASSWORD","gestor"); //Esto dependerá del password claro
define("USUARIO","gestor");//usamos el root por comodidad, pero es poco seguro
define("BB_DD","trabajo_daw");//base de datos creada con anterioridad
define("SERVIDOR","localhost");//base de datos creada con anterioridad


function conectar(){
$conexion=null;
  try{
    $opciones=  array( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION );	
    $conexion = new PDO('mysql:host='. SERVIDOR . ';dbname=' . 	BB_DD, USUARIO, PASSWORD, $opciones);
  }catch(Exception $e){
	echo "Ocurrió algo con la base de datos: " . $e->getMessage();
  }
  return $conexion;
}
?>