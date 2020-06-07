<?php
include_once("../../funciones/base_datos.php");
$conexion=conectar();



$consulta="SELECT idTour FROM tour";
$sentencia = $conexion->prepare($consulta);
$sentencia->execute();
$tours = $sentencia->fetchAll(PDO::FETCH_ASSOC);
 

$contador = 0;

foreach ($tours as $tour) {
    $cod = $tour['idTour'];
    $array[$contador]['idTour']= $cod;
    $array[$contador]['borrable']= true;


    $consulta="SELECT idTour FROM horarios where idTour = :idTour";
    $sentencia = $conexion->prepare($consulta);
    $sentencia->execute([":idTour" => $cod]);


    if ($sentencia->rowCount()>=1) {
        $array[$contador]['borrable']= false;
    } 


    $consulta="SELECT idTour FROM reservapersonalizada where idTour = :idTour";
    $sentencia = $conexion->prepare($consulta);
    $sentencia->execute([":idTour" => $cod]);


    if ($sentencia->rowCount()>=1) {
        $array[$contador]['borrable']= false;

    } 

    $consulta="SELECT idTour FROM reservas where idTour = :idTour";
    $sentencia = $conexion->prepare($consulta);
    $sentencia->execute([":idTour" => $cod]);


    if ($sentencia->rowCount()>=1) {
        $array[$contador]['borrable']= false;

    } 


    $consulta="SELECT idTour FROM tourguia where idTour = :idTour";
    $sentencia = $conexion->prepare($consulta);
    $sentencia->execute([":idTour" => $cod]);


    if ($sentencia->rowCount()>=1) {
        $array[$contador]['borrable']= false;
    } 
    
    $contador++;
}
echo json_encode($array);





