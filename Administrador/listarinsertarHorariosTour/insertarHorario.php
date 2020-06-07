
<?php
$resultado;

include_once("../../funciones/base_datos.php");
include_once("../funciones/funciones.php");

$conexion=conectar();
$num= $_REQUEST['numAnyadir'];
$id=$_REQUEST['idTour'];

for($i=1; $i<=$num; $i++){
    $horario = $_REQUEST["anyadir". $i];

    $horario = str_replace('T', ' ', $horario);

    $horario = date_create($horario);
    $horario = date_format($horario, 'Y-m-d H:i:s'); 

    $sentencia = $conexion->prepare("INSERT INTO horarios(idTour, horario)
                                 VALUES (:idTour, :horario );");

    $resultado = $sentencia->execute([":idTour"=>$id, ":horario"=>$horario]);
}


if($resultado === TRUE) $mensajes["insertar"]=true;
else $mensajes["insertar"]=false;


    


echo json_encode($mensajes);