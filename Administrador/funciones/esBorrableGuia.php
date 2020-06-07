<?php
include_once("../../funciones/base_datos.php");
$conexion=conectar();



$consulta="SELECT idGuia FROM guias";
$sentencia = $conexion->prepare($consulta);
$sentencia->execute();
$guias = $sentencia->fetchAll(PDO::FETCH_ASSOC);
 

$contador = 0;

foreach ($guias as $guia) {
    $cod = $guia['idGuia'];
    $array[$contador]['idGuia']= $cod;
    $array[$contador]['borrable']= true;


    $consulta="SELECT idGuia FROM reservapersonalizada where idGuia = :idGuia";
    $sentencia = $conexion->prepare($consulta);
    $sentencia->execute([":idGuia" => $cod]);


    if ($sentencia->rowCount()>=1) {
        $array[$contador]['borrable']= false;

    } 

    $consulta="SELECT idGuia FROM reservas where idGuia = :idGuia";
    $sentencia = $conexion->prepare($consulta);
    $sentencia->execute([":idGuia" => $cod]);


    if ($sentencia->rowCount()>=1) {
        $array[$contador]['borrable']= false;

    } 


    $consulta="SELECT idGuia FROM tourguia where idGuia = :idGuia";
    $sentencia = $conexion->prepare($consulta);
    $sentencia->execute([":idGuia" => $cod]);


    if ($sentencia->rowCount()>=1) {
        $array[$contador]['borrable']= false;
    } 
    
    $contador++;
}
echo json_encode($array);





