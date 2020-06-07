<?php
include_once("../funciones/funciones.php");
include_once("../../funciones/base_datos.php");

session_start();
$conexion = conectar();

$sql="SELECT * FROM tour";
$sentencia = $conexion->prepare($sql);
$sentencia->execute();
$tours = $sentencia->fetchAll(PDO::FETCH_ASSOC);


if($_SESSION['usuario']){
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Tours</title>
    <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../bootstrap/micss.css" rel="stylesheet">
</head>

<body>
    <?=cabecera();?>
    <div class="container col-12 align-items-center pagina">
        <div class="col-10 offset-1 formAñadirCliente">
            <?php 
                        foreach ($tours as $indice =>$tour) {
                            ?>
            <div>
                <form action="verUnTour.php" method="POST">
                    <input type="submit" class="btn btn-link" id="verTour" value="<?=$tour['titulo']?>"
                        style="font-size:28px; margin-bottom:1%">
                    <input type="hidden" id="idTour" name="idTour" value="<?=$tour['idTour']?>">
                </form>
                <div>
                    <img src="../../imagenesTour/<?=$tour['idTour']?>/principal.jpg" class="imagenVerTodosTour">
                    <p class="parrafoTodosTour"><?=$tour['descripcion']?></p>
                    <h4 class="parrafoTodosTour"><?=$tour['precio']?>€</h4>
                </div>
            </div>

            <br><br>
            <hr>
            <?php
                        } ?>
        </div>
    </div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</html>

<?php
    }else{
        header ("Location: ../../login/login.html");
    }?>