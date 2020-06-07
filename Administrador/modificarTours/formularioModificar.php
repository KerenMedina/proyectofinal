<?php
include_once("../../funciones/base_datos.php");
include_once("../funciones/funciones.php");
session_start();
if($_SESSION['usuario'] ){
    if (isset($_POST['codigoModificar'])) {
        $cod=$_POST['codigoModificar'];
        $conexion=conectar();
        $sql="SELECT * FROM tour WHERE idTour = :cod";
        $sentencia = $conexion->prepare($sql);
        $sentencia->execute([":cod" => $cod]);
        $tour = $sentencia->fetchAll(PDO::FETCH_ASSOC);

        $pasarTour=json_encode($tour);

         ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Modificar tour</title>
    <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../bootstrap/micss.css" rel="stylesheet">
</head>

<body>
    <?=cabecera(); ?>
    <div class="container col-12 align-items-center pagina">
        <div class="col-12 ">
            <div class="col-10 offset-md-1 formAñadirCliente">
                <h2 class="offset-2 col-md-8" style="background-color:#6495ed89; border-radius: 5px;">Modificar tour <?=$cod?>
                </h2>
                <br>

                <form method="POST" id="formulario">
                    <input type="hidden" name="tour" id="tour" value='<?=$pasarTour?>'>
                    <div class="form-group row ">
                        <label for="pass" class="col-md-8 offset-2 col-form-label ">Codigo</label>
                        <div class="col-md-8 offset-2">
                            <p><?=$cod?></p>
                            <input type="hidden" name="codigo" id="codigo" value="<?=$cod?>">
                        </div>
                    </div>


                    <div class="form-group row ">
                        <label for="titulo" class="col-md-8 offset-2 col-form-label ">Titulo</label>
                        <div class="col-md-8 offset-2">
                            <input type="text" class="form-control" require name="titulo" id="titulo"
                                value="<?=$tour[0]['titulo']?>">

                        </div>
                    </div>
                    <div class="row">
                        <div id="errorTitulo" class="col-md-6 offset-3"></div>
                    </div>

                    <div class="form-group row ">
                        <label for="descripcion" class="col-md-8 offset-2 col-form-label ">Descripción</label>
                        <div class="col-md-8 offset-2">
                            <textarea class="form-control" require name="descripcion"
                                id="descripcion"><?=$tour[0]['descripcion']?> </textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div id="errorDescripcion" class="offset-md-3 col-md-6"></div>
                    </div>

                    <div class="form-group row ">
                        <label for="pass " class="col-md-8 offset-2 col-form-label ">Precio</label>
                        <div class="col-md-8 offset-2">
                            <input type="text" class="form-control" require name="precio" id="precio"
                                value="<?=$tour[0]['precio']?>">
                        </div>
                    </div>
                    <div class="row">
                        <div id="errorPrecio" class="col-md-6 offset-3"></div>
                    </div>


                    <div class="col-md-2 offset-9">
                        <input type="button" id="boton" name="boton" disabled class="btn btn-light" value="Actualizar">
                    </div>

                </form>
            </div>
        </div>
    </div>
    </div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="modificar.js"></script>

</html>

<?php
    }
    }else{
        header ("Location: ../../login/login.html");
    }?>