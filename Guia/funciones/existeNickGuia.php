<?php
include_once("../../funciones/base_datos.php");

//RECIBIR DATOS
    /*if (empty($_REQUEST['nick'])) {
        $mensajes['nick'] = false;
    }*/
    
    try{
        $mensajes['nick']=false;
        $conexion=conectar();
        $nick=$_REQUEST['nick'];

        //$nick="keren";
        $consulta="SELECT nick FROM guias where nick = :nick";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([":nick" => $nick]);


        if($sentencia->rowCount()==1){
            $mensajes["nick"]=true;
        }
   }catch(Exception $e){
       // echo $e->getMessage();
    }
    echo json_encode($mensajes);
    
?>
