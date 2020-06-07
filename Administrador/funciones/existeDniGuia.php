<?php
include_once("../../funciones/base_datos.php");

//RECIBIR DATOS
    /*if (empty($_REQUEST['dni'])) {
        $mensajes['dni'] = false;
    }*/
    
    try{
        $mensajes['dni']=false;
        $conexion=conectar();
        $dni=$_REQUEST['dni'];

        //$dni="12345678B";
        $consulta="SELECT DNI FROM guias where DNI = :dni";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([":dni" => $dni]);


        if($sentencia->rowCount()==1){
            $mensajes["dni"]=true;
        }
   }catch(Exception $e){
       // echo $e->getMessage();
    }
    echo json_encode($mensajes);
    
?>
