<?php
include_once("../funciones/funciones.php");

session_start();
if($_SESSION['usuario']){

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Inicio cliente</title>
    <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../bootstrap/micss.css" rel="stylesheet">
</head>

<body>
    <?=cabecera();?>
    <p></p>
    <img src="../../imagenes/pagPrincipalGuia.png" style="margin-left:3%">

</body>
<script type="text/javascript" src="../funciones/slider.js"></script>

</html>


<?php
}else{
    header ("Location: ../../login/login.html");
}

?>