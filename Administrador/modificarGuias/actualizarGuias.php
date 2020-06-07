<?php
include_once("../../funciones/base_datos.php");
$conexion=conectar();

$cod=$_REQUEST['codigo'];
$nick=$_REQUEST['nick'];
$dni=$_REQUEST['dni'];
$pass=$_REQUEST['pass'];
$email=$_REQUEST['email'];
$telefono=$_REQUEST['telefono'];
$idioma1=$_REQUEST['idioma1'];
$idioma2=$_REQUEST['idioma2'];
$idioma3=$_REQUEST['idioma3'];






$sentencia = $conexion->prepare("UPDATE guias SET nick = :nick, contrasenya = :contrasenya,
                                DNI = :dni, email = :email, telefono = :telefono, 
                                idioma1 = :idioma1, idioma2 = :idioma2, idioma3 = :idioma3
                                WHERE idGuia= :cod ");
$resultado = $sentencia->execute([":dni"=>$dni, ":email"=>$email, ":telefono"=>$telefono,
                                ":nick"=>$nick, ":contrasenya"=>$pass,
                                ":idioma1" => $idioma1, ":idioma2" =>$idioma2, ":idioma3" => $idioma3,
                                ":cod"=>$cod]);

    
if($resultado === TRUE) $mensajes["actualizar"]=true;
else $mensajes["actualizar"]=false;

echo json_encode($mensajes);