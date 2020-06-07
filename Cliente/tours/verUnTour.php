<?php
include_once("../funciones/funciones.php");
include_once("../../funciones/base_datos.php");

$conexion = conectar();

$idTour=$_REQUEST['idTour'];

$sql="SELECT * FROM tour WHERE idTour = :idTour";
$sentencia = $conexion->prepare($sql);
$sentencia->execute(["idTour" => $idTour]);
$tour = $sentencia->fetchAll(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ver tour</title>
    <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../bootstrap/micss.css" rel="stylesheet">
</head>

<body>
    <?=cabecera();?>
    <div class="container col-12 align-items-center pagina">
        <div class="col-10 offset-1 formAñadirCliente">
            <div>
                <h1 style="color:cornflowerblue; text-align:center; margin-bottom:3%"><?=$tour[0]['titulo']?></h1>
                <div>
                    <div class="slider">
                        <a href=""><img class="active imagen"
                                src="../../imagenesTour/<?=$tour[0]['idTour']?>/1.jpg"></a>
                        <a href=""><img class="imagen" src="../../imagenesTour/<?=$tour[0]['idTour']?>/2.jpg"></a>
                        <a href=""><img class="imagen" src="../../imagenesTour/<?=$tour[0]['idTour']?>/3.jpg"></a>

                    </div>
                    <p class="parrafoUnTour"><?=$tour[0]['descripcion']?></p>
                    <h4 class="parrafoUnTour"><?=$tour[0]['precio']?>€</h4>
                    <form action="../reservarTour/reservarTour.php" method="POST">
                        <input type="submit" class="btn btn-primary offset-10" name="reservarTour" id="reservarTour" value="Reservar">
                        <input type="hidden" name="idTour" id="idTour" value="<?=$idTour?>">
                    </form>
                </div>
            </div>

        </div>
    </div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="../funciones/slider.js"></script>


</html>