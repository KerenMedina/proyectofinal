<?php
include_once("../../funciones/base_datos.php");
    
    try{
        $mensajes['reserva']=false;
        $conexion=conectar();
        $idTour=$_REQUEST['idTour'];
        $idCliente=$_REQUEST['idCliente'];

        //$nick="keren";
        $consulta="SELECT * FROM reservas where idCliente = :idCliente AND idTour = :idTour ";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([":idCliente" => $idCliente, ":idTour" => $idTour]);
        $reservas = $sentencia->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($reservas);
   }catch(Exception $e){
       // echo $e->getMessage();
    }
    
    
?>