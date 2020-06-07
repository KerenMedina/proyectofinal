<?php
include_once("../../funciones/base_datos.php");
session_start();

$conexion=conectar();

$usuario = $_SESSION['usuario'];

$sql="SELECT idGuia FROM guias WHERE nick = :nick";
$sentencia = $conexion->prepare($sql);
$sentencia->execute([":nick" => $usuario]);
$guia = $sentencia->fetchAll(PDO::FETCH_ASSOC);

$cod = $guia[0]['idGuia'];



$array = [];



$sql="SELECT * FROM reservapersonalizada WHERE idGuia = :cod";
$sentencia = $conexion->prepare($sql);
$sentencia->execute([":cod" => $cod]);
$reservas = $sentencia->fetchAll(PDO::FETCH_ASSOC);

$contador = 0;

foreach($reservas as $reserva){
    $array[$contador]['idReserva'] = $reserva['idReservaPersonalizada'];

    $sql="SELECT titulo FROM tour WHERE idTour = :cod";
    $sentencia = $conexion->prepare($sql);
    $sentencia->execute([":cod" => $reserva['idTour']]);
    $tour = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    $array[$contador]['tour']= $tour[0]['titulo'];


    $sql="SELECT nick FROM clientes WHERE idCliente = :cod";
    $sentencia = $conexion->prepare($sql);
    $sentencia->execute([":cod" => $reserva['idCliente']]);
    $cliente = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    $array[$contador]['cliente']= $cliente[0]['nick'];

    $array[$contador]['horario']= $reserva['horario'];
    $array[$contador]['idioma']= $reserva['idioma'];
    $array[$contador]['estado']= $reserva['estado'];

    $contador++;
}
echo json_encode($array);