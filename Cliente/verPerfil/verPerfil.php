<?php
include_once("../funciones/funciones.php");
include_once("../../funciones/base_datos.php");

session_start();
$conexion = conectar();
$usuario = $_SESSION['usuario'];

$sql="SELECT * FROM clientes WHERE nick = :nick";
$sentencia = $conexion->prepare($sql);
$sentencia->execute([":nick" => $usuario]);
$cliente = $sentencia->fetchAll(PDO::FETCH_ASSOC);

$pasarCliente=json_encode($cliente);


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
        <div class="col-12 ">
            <div class="col-10 offset-md-1 formAñadirCliente">
                <h2 class="offset-2 col-md-8" style="background-color:#6495ed89; border-radius: 5px;">Modificar mi perfil
                </h2>
                <br>
                <div class="form-group row ">
                    <div class="col-md-2 offset-2">
                        <?php
                            if($cliente[0]['imagen'] != ""){
                                echo '<img class="imagenPerfilenModificar" src="../../imagenesCliente/'. $cliente[0]['imagen'] .'" >';
                            
                            } else{
                                echo '<img class="imagenPerfilenModificar" src="../../imagenesCliente/default.jpg">';

                            }

                            ?>
                    </div>
                    <form method="POST" id="formulario">
                        <input type="hidden" name="cliente" id="cliente" value='<?=$pasarCliente?>'>
                            <label for="pass " class="col-md-8 offset-2 col-form-label ">Codigo</label>
                            <div class="col-md-8 offset-2">
                                <p><?=$cliente[0]['idCliente']?></p>
                                <input type="hidden" name="codigo" id="codigo" value="<?=$cliente[0]['idCliente']?>">
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label for="pass " class="col-md-8 offset-2 col-form-label ">Nick</label>
                            <div class="col-md-8 offset-2">
                                <input type="text" class="form-control" require name="nick" id="nick"
                                    value="<?=$cliente[0]['nick']?>">
                                <input type="hidden" name="antiguoNick" id="antiguoNick"
                                    value='<?=$cliente[0]['nick']?>'>

                            </div>
                        </div>
                        <div class="row">
                            <div id="errorNick" class="col-md-6 offset-3"></div>
                        </div>

                        <div class="form-group row ">
                            <label for="pass " class="col-md-8 offset-2 col-form-label ">Contraseña</label>
                            <div class="col-md-8 offset-2">
                                <input type="text" class="form-control" require name="pass" id="pass"
                                    value="<?=$cliente[0]['contrasenya']?>">
                            </div>
                        </div>
                        <div class="row">
                            <div id="errorPass" class="offset-md-3 col-md-6"></div>
                        </div>

                        <div class="form-group row ">
                            <label for="pass " class="col-md-8 offset-2 col-form-label ">DNI</label>
                            <div class="col-md-8 offset-2">
                                <input type="text" class="form-control" require name="dni" id="dni"
                                    value="<?=$cliente[0]['DNI']?>">
                            </div>
                        </div>
                        <div class="row">
                            <div id="errorDNI" class="col-md-6 offset-3"></div>
                        </div>

                        <div class="form-group row ">
                            <label for="pass " class="col-md-8 offset-2 col-form-label ">Direccion</label>
                            <div class="col-md-8 offset-2">
                                <input type="text" class="form-control" require name="direccion" id="direccion"
                                    value="<?=$cliente[0]['direccion']?>">
                            </div>
                        </div>

                        <div class="row">
                            <div id="errorDomicilio" class="offset-md-3 col-md-6"></div>
                        </div>

                        <div class="form-group row ">
                            <label for="pass " class="col-md-8 offset-2 col-form-label ">Ciudad</label>
                            <div class="col-md-8 offset-2">
                                <input type="text" class="form-control" require name="ciudad" id="ciudad"
                                    value="<?=$cliente[0]['ciudad']?>">
                            </div>
                        </div>

                        <div class="row">
                            <div id="errorCiudad" class="offset-md-3 col-md-6"></div>
                        </div>

                        <div class="form-group row ">
                            <label for="pass " class="col-md-8 offset-2 col-form-label ">Email</label>
                            <div class="col-md-8 offset-2">
                                <input type="email" class="form-control" require name="email" id="email"
                                    value="<?=$cliente[0]['email']?>">
                            </div>
                        </div>

                        <div class="row">
                            <div id="errorEmail" class="offset-md-3 col-md-6"></div>
                        </div>

                        <div class="form-group row ">
                            <label for="pass " class="col-md-8 offset-2 col-form-label ">Telefono</label>
                            <div class="col-md-8 offset-2">
                                <input type="tel" class="form-control" require name="telefono" id="telefono"
                                    value="<?=$cliente[0]['telefono']?>">
                            </div>
                        </div>
                        <div class="row">
                            <div id="errorTel" class="offset-md-3 col-md-6"></div>
                        </div>

                        <div class="col-md-2 offset-9">
                            <input type="button" id="boton" name="boton" disabled class="btn btn-light"
                                value="Actualizar">
                        </div>

                    </form>
                </div>
            </div>
        </div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="modificar.js"></script>

</html>

<?php
    }else{
        header ("Location: ../../login/login.html");
    }?>