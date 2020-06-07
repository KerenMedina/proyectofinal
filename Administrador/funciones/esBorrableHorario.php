<?php
include_once("../../funciones/base_datos.php");
$conexion=conectar();



$consulta="SELECT idHorario FROM horarios";
$sentencia = $conexion->prepare($consulta);
$sentencia->execute();
$horarios = $sentencia->fetchAll(PDO::FETCH_ASSOC);
 

$contador = 0;

foreach ($horarios as $horario) {
    $cod = $horario['idHorario'];
    $array[$contador]['idHorario']= $cod;
    $array[$contador]['borrable']= true;


    $consulta="SELECT idHorario FROM reservas where idHorario = :idHorario";
    $sentencia = $conexion->prepare($consulta);
    $sentencia->execute([":idHorario" => $cod]);


    if ($sentencia->rowCount()>=1) {
        $array[$contador]['borrable']= false;

    }

    $contador++;
}
echo json_encode($array);





