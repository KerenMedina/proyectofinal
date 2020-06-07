<?php
include_once("../../funciones/base_datos.php");
$conexion=conectar();



$consulta="SELECT idCliente FROM clientes";
$sentencia = $conexion->prepare($consulta);
$sentencia->execute();
$clientes = $sentencia->fetchAll(PDO::FETCH_ASSOC);
 

$contador = 0;

foreach ($clientes as $cliente) {
    $cod = $cliente['idCliente'];
    $array[$contador]['idCliente']= $cod;
    $array[$contador]['borrable']= true;


    $consulta="SELECT idCliente FROM reservapersonalizada where idCliente= :idCliente";
    $sentencia = $conexion->prepare($consulta);
    $sentencia->execute([":idCliente" => $cod]);


    if ($sentencia->rowCount()>=1) {
        $array[$contador]['borrable']= false;

    }

    $consulta="SELECT idCliente FROM reservas where idCliente = :idCliente";
    $sentencia = $conexion->prepare($consulta);
    $sentencia->execute([":idCliente" => $cod]);


    if ($sentencia->rowCount()>=1) {
        $array[$contador]['borrable']= false;

    }

    $contador++;
}
echo json_encode($array);





