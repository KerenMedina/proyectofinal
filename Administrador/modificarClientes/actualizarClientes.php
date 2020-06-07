<?php
include_once("../../funciones/base_datos.php");
$conexion=conectar();

$cod=$_REQUEST['codigo'];
$nick=$_REQUEST['nick'];
$dni=$_REQUEST['dni'];
$pass=$_REQUEST['pass'];
$ciudad=$_REQUEST['ciudad'];
$direccion=$_REQUEST['direccion'];
$email=$_REQUEST['email'];
$telefono=$_REQUEST['telefono'];





$sentencia = $conexion->prepare("UPDATE clientes SET nick = :nick, contrasenya = :contrasenya,
                                DNI = :dni, direccion = :direccion, email = :email, ciudad= :ciudad,
                                telefono = :telefono 
                                WHERE idCliente= :cod ");
$resultado = $sentencia->execute([":dni"=>$dni, ":direccion"=>$direccion, ":ciudad"=>$ciudad,
                                  ":email"=>$email, ":telefono"=>$telefono, ":nick"=>$nick, 
                                  ":contrasenya"=>$pass, "cod"=>$cod]);

    
if($resultado === TRUE) $mensajes["actualizar"]=true;
else $mensajes["actualizar"]=false;

echo json_encode($mensajes);