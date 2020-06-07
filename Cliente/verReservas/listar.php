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



$sql="SELECT * FROM reservas WHERE idCliente = :cod";
$sentencia = $conexion->prepare($sql);
$sentencia->execute([":cod" => $cod]);
$reservas = $sentencia->fetchAll(PDO::FETCH_ASSOC);

$contador = 0;

foreach($reservas as $reserva){
    $array[$contador]['idReserva'] = $reserva['idReserva'];

    $sql="SELECT titulo FROM tour WHERE idTour = :cod";
    $sentencia = $conexion->prepare($sql);
    $sentencia->execute([":cod" => $reserva['idTour']]);
    $tour = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    $array[$contador]['tour']= $tour[0]['titulo'];

    $sql="SELECT nick FROM guias WHERE idGuia = :cod";
    $sentencia = $conexion->prepare($sql);
    $sentencia->execute([":cod" => $reserva['idGuia']]);
    $guia = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    $array[$contador]['guia']= $guia[0]['nick'];

    $sql="SELECT horario FROM horarios WHERE idHorario = :cod";
    $sentencia = $conexion->prepare($sql);
    $sentencia->execute([":cod" => $reserva['idHorario']]);
    $horario = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    $array[$contador]['horario']= $horario[0]['horario'];

    $contador++;
}


echo json_encode($array);