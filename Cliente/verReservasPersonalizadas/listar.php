<?php
include_once("../../funciones/base_datos.php");
session_start();

$conexion=conectar();

$usuario = $_SESSION['usuario'];

$sql="SELECT idCliente FROM clientes WHERE nick = :nick";
$sentencia = $conexion->prepare($sql);
$sentencia->execute([":nick" => $usuario]);
$cliente = $sentencia->fetchAll(PDO::FETCH_ASSOC);

$cod = $cliente[0]['idCliente'];

$array = [];



$sql="SELECT * FROM reservapersonalizada WHERE idCliente = :cod";
$sentencia = $conexion->prepare($sql);
$sentencia->execute([":cod" => $cod]);
$personalizadas = $sentencia->fetchAll(PDO::FETCH_ASSOC);

$contador = 0;

foreach($personalizadas as $personalizada){
    $array[$contador]['idReserva'] = $personalizada['idReservaPersonalizada'];

    $sql="SELECT titulo FROM tour WHERE idTour = :cod";
    $sentencia = $conexion->prepare($sql);
    $sentencia->execute([":cod" => $personalizada['idTour']]);
    $tour = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    $array[$contador]['tour']= $tour[0]['titulo'];

    $sql="SELECT nick FROM guias WHERE idGuia = :cod";
    $sentencia = $conexion->prepare($sql);
    $sentencia->execute([":cod" => $personalizada['idGuia']]);
    $guia = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    $array[$contador]['guia']= $guia[0]['nick'];

    $array[$contador]['horario']= $personalizada['horario'];
    $array[$contador]['idioma']= $personalizada['idioma'];
    $array[$contador]['estado']= $personalizada['estado'];

    $contador++;
}


echo json_encode($array);