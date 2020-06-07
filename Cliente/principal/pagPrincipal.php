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
    <div class="slider">
        <form action="../tours/verUnTour.php" method="POST">
            <input type="image" class="active imagen" src="../../slider/1.jpg">
            <input type="hidden" name="idTour" id="idTour" value="11">
        </form>

        <form action="../tours/verUnTour.php" method="POST">
            <input type="image" class="imagen" src="../../slider/2.jpg">
            <input type="hidden" name="idTour" id="idTour" value="12">
        </form>
        
        <form action="../tours/verUnTour.php" method="POST">
            <input type="image" class="imagen" src="../../slider/3.jpg">
            <input type="hidden" name="idTour" id="idTour" value="13">
        </form>

    </div>

</body>
<script type="text/javascript" src="../funciones/slider.js"></script>

</html>


<?php
}else{
    header ("Location: ../../login/login.html");
}

?>