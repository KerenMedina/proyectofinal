<?php
include_once("../funciones/funciones.php");

session_start();
if($_SESSION['usuario']){
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Añadir guia</title>
    <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../bootstrap/micss.css" rel="stylesheet">
</head>

<body>
    <?=cabecera();?>
    <div class="container col-12 align-items-center pagina">
        <div class="col-12 ">
            <div class="col-10 offset-md-1 formAñadirCliente">
                <h2 class="offset-2 col-md-8" style="background-color:#6495ed89; border-radius: 5px;">Guia nuevo</h2>
                <br>
                <form method="POST" id="formulario">
                    <div class="form-group row ">
                        <label for="nick" class="col-md-8 offset-2 col-form-label ">Nick</label>
                        <div class="col-md-8 offset-2">
                            <input type="text" class="form-control" require name="nick" id="nick">
                        </div>
                    </div>
                    <div class="row">
                        <div id="errorNick" class="col-md-6 offset-3"></div>
                    </div>

                    <div class="form-group row ">
                        <label for="pass " class="col-md-8 offset-2 col-form-label ">Contraseña</label>
                        <div class="col-md-8 offset-2">
                            <input type="password" class="form-control" require name="pass" id="pass">
                        </div>
                    </div>
                    <div class="row">
                        <div id="errorPass" class="offset-md-3 col-md-6"></div>
                    </div>

                    <div class="form-group row ">
                        <label for="dni " class="col-md-8 offset-2 col-form-label ">DNI</label>
                        <div class="col-md-8 offset-2">
                            <input type="text" class="form-control" require name="dni" id="dni">
                        </div>
                    </div>
                    <div class="row">
                        <div id="errorDNI" class="col-md-6 offset-3"></div>
                    </div>

                    <div class="form-group row ">
                        <label for="email " class="col-md-8 offset-2 col-form-label ">Email</label>
                        <div class="col-md-8 offset-2">
                            <input type="email" class="form-control" require name="email" id="email">
                        </div>
                    </div>

                    <div class="row">
                        <div id="errorEmail" class="offset-md-3 col-md-6"></div>
                    </div>

                    <div class="form-group row ">
                        <label for="telefono " class="col-md-8 offset-2 col-form-label ">Telefono</label>
                        <div class="col-md-8 offset-2">
                            <input type="tel" class="form-control" require name="telefono" id="telefono">
                        </div>
                    </div>
                    <div class="row">
                        <div id="errorTel" class="offset-md-3 col-md-6"></div>
                    </div>

                    

                    <div class="form-group row ">
                        <div class="col-md-8 offset-2">
                        <label for="idioma1" class="col-md-12 col-form-label ">idioma1</label>

                            <select name="idioma1" id="idioma1">
                                <option value="ingles">Ingles</option>
                                <option value="espanyol">Español</option>
                                <option value="aleman">Aleman</option>
                                <option value="frances">Frances</option>
                                <option value="Italiano">Italiano</option>
                            </select>

                            <div id="selectIdiomas2">
                            </div>
                            <div id="selectIdiomas3">
                            </p>
                            <img src="../imagenPlus.png" class="iconoMas" id="masIdiomas">
                        </div>
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
<script type="text/javascript" src="guia.js"></script>

</html>

<?php
    }else{
        header ("Location: ../../login/login.html");
    }?>