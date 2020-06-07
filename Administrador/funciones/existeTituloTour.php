<?php
include_once("../../funciones/base_datos.php");

    
    try{
        $mensajes['titulo']=false;
        $conexion=conectar();
        $titulo=$_REQUEST['titulo'];

        $consulta="SELECT titulo FROM tour where titulo = :titulo";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([":titulo" => $titulo]);


        if($sentencia->rowCount()==1){
            $mensajes["titulo"]=true;
        }
   }catch(Exception $e){
       // echo $e->getMessage();
    }
    echo json_encode($mensajes);
    
?>
