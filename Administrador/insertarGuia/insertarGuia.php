<?php
include_once("../../funciones/base_datos.php");
$conexion=conectar();

$nick=$_REQUEST['nick'];
$dni=$_REQUEST['dni'];
$pass=$_REQUEST['pass'];
$email=$_REQUEST['email'];
$telefono=$_REQUEST['telefono'];
$idioma1 = $_REQUEST['idioma1'];

if(isset($_REQUEST['idioma2'])){
       $idioma2 = $_REQUEST['idioma2'];
}else{
       $idioma2 = '';
}

if(isset($_REQUEST['idioma3'])){
       $idioma3 = $_REQUEST['idioma3'];
}else{
       $idioma3 = '';
}

$sentencia = $conexion->prepare("INSERT INTO guias(DNI, email, telefono, nick, 
                                                 contrasenya, idioma1, idioma2, idioma3)
                                 VALUES (:dni, :email, :telefono, :nick, 
                                          :contrasenya, :idioma1, :idioma2, :idioma3);");
$resultado = $sentencia->execute([":dni"=>$dni, ":email"=>$email, 
                                  ":telefono"=>$telefono, ":nick"=>$nick, ":contrasenya"=>$pass,
                                  ":idioma1" => $idioma1, ":idioma2" => $idioma2, ":idioma3" => $idioma3]);

    
if($resultado === TRUE) $mensajes["insertar"]=true;
else $mensajes["insertar"]=false;

echo json_encode($mensajes);