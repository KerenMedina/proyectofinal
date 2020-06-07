<?php
include_once("../../funciones/base_datos.php");

$idioma = $_REQUEST['idioma'];

$conexion=conectar(); // Se conecta con la base de datos.
 //seleccionamos todos los datos que hay en datos
$sql="SELECT * FROM guias WHERE idioma1 = :idioma OR idioma2 = :idioma OR idioma3 = :idioma";
$sentencia = $conexion->prepare($sql);
$sentencia->execute([":idioma" => $idioma]);
$guias = $sentencia->fetchAll(PDO::FETCH_ASSOC);


echo json_encode($guias);
$conexion=null;
?>