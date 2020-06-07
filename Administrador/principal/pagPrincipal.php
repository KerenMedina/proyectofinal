<?php
include_once("../funciones/funciones.php");

session_start();
if($_SESSION['usuario']){

?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <title>Inicio admin</title>
        <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../../bootstrap/micss.css" rel="stylesheet">
    </head>

    <body>
        <?=cabecera();?>
                <h2 class="offset-1" style="margin-top:2%; color:cornflowerblue">TRAFICO DE LA WEB</h2>
                <img src="../../imagenes/traficoWeb.jpg" style="margin-left:7%; margin-top:2%">
                
    </body>
    <script type="text/javascript" src="../funciones/slider.js"></script>
    </html>


    <?php
}else{
    header ("Location: ../../login/login.html");
}

?>