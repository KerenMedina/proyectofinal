<?php
include_once("../../funciones/base_datos.php");
$conexion=conectar();

$nick=$_REQUEST['nick'];
$dni=$_REQUEST['dni'];
$pass=$_REQUEST['pass'];
$ciudad=$_REQUEST['ciudad'];
$direccion=$_REQUEST['direccion'];
$email=$_REQUEST['email'];
$telefono=$_REQUEST['telefono'];


$sentencia = $conexion->prepare("INSERT INTO clientes(DNI, direccion, 
                                                    ciudad, email, telefono, nick, contrasenya)
                                 VALUES (:dni, :direccion, :ciudad, :email, 
                                        :telefono, :nick, :contrasenya);");
$resultado = $sentencia->execute([":dni"=>$dni, ":direccion"=>$direccion, ":ciudad"=>$ciudad,
                                  ":email"=>$email, ":telefono"=>$telefono, ":nick"=>$nick, 
                                  ":contrasenya"=>$pass]);

    
if($resultado === TRUE) $mensajes["insertar"]=true;
else $mensajes["insertar"]=false;

echo json_encode($mensajes);