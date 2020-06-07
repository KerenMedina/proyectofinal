<?php
include_once("../funciones/funciones.php");

session_start();
if($_SESSION['usuario']){
?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <title>Añadir tour</title>
        <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../../bootstrap/micss.css" rel="stylesheet">
    </head>

    <body>
        <?=cabecera();?>
            <div class="container col-12 align-items-center pagina">
                <div class="col-12 ">
                    <div class="col-10 offset-md-1 formAñadirCliente">
                        <h2 class="offset-2 col-md-8" style="background-color:#6495ed89; border-radius: 5px;">Tour nuevo</h2>
                        <br>
                        <form method="POST" id="formulario">
                            <div class="form-group row ">
                                <label for="titulo" class="col-md-8 offset-2 col-form-label ">Título</label>
                                <div class="col-md-8 offset-2">
                                    <input type="text" class="form-control" require name="titulo" id="titulo">
                                </div>
                            </div>
                            <div class="row">
                                <div id="errorTitulo" class="col-md-6 offset-3"></div>
                            </div>

                            <div class="form-group row ">
                                <label for="descripcion" class="col-md-8 offset-2 col-form-label ">Descripción</label>
                                <div class="col-md-8 offset-2">
                                <textarea name="descripcion" class="form-control" id="descripcion" cols="85" rows="5"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div id="errorDescripcion" class="offset-md-3 col-md-6"></div>
                            </div>
                            
                            <div class="form-group row ">
                                <label for="precio" class="col-md-8 offset-2 col-form-label ">Precio</label>
                                <div class="col-md-8 offset-2">
                                    <input type="number" class="form-control" require min="0" name="precio" id="precio">
                                </div>
                            </div>

                            <div class="row">
                                <div id="errorPrecio" class="offset-md-3 col-md-6"></div>
                            </div>

                            <div class="form-group row ">
                                <label for="precio" class="col-md-8 offset-2 col-form-label ">Guia</label>
                                <div class="col-md-10 offset-2" id=contenidoSelect>
                                </div>
                            </div>

                            <div class="row">
                                <div id="errorGuia" class="offset-md-3 col-md-6"></div>
                            </div>

                            <div class="col-md-2 offset-9">
                                <input type="button" id="boton" disabled class="btn btn-light" value="Añadir">
                            </div>

                        </form>
                    </div>
                </div>
            </div>
    </body>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="tour.js"></script>
    </html>

    <?php
    }else{
        header ("Location: ../../login/login.html");
    }?>