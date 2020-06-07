<?php
include_once("../funciones/funciones.php");

session_start();
if($_SESSION['usuario']){

?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <title>Listar clientes</title>
        <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../../bootstrap/micss.css" rel="stylesheet">
    </head>

    <body>
        <?=cabecera();?>
            <div class="container row align-items-center">
                <div class="col-12">
                    <div id="contenidoSelect">
                    </div>
                    <div id="tablaClientes" class="container row">
                    </div>
                </div>
            </div>


    </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="listarClientes.js"></script>

    </html>


    <?php
}else{
    header ("Location: ../../login/login.html");
}

?>