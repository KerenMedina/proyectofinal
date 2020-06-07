<?php
include_once("../../funciones/base_datos.php");
include_once("../funciones/funciones.php");
session_start();
if($_SESSION['usuario'] ){

        $conexion = conectar();
        $usuario = $_SESSION['usuario'];
        
        $sql="SELECT * FROM guias WHERE nick = :nick";
        $sentencia = $conexion->prepare($sql);
        $sentencia->execute([":nick" => $usuario]);
        $guia = $sentencia->fetchAll(PDO::FETCH_ASSOC);

    $pasarGuia=json_encode($guia);

    $imagen = $guia[0]['imagen'];
    ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Modificar guia</title>
    <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../bootstrap/micss.css" rel="stylesheet">
</head>

<body>
    <?=cabecera();?>
    <div class="container col-12 align-items-center pagina">
        <div class="col-12 ">
            <div class="col-10 offset-md-1 formAñadirCliente">
                <h2 class="offset-2 col-md-8" style="background-color:#6495ed89; border-radius: 5px;">Modificar guia
                </h2>
                <br>
                <div class="form-group row ">
                    <div class="col-md-2 offset-2">
                        <?php
                            if($imagen != ""){
                                echo '<img class="imagenPerfilenModificar" src="../../imagenesGuia/'. $imagen .'" >';
                            
                            } else{
                                echo '<img class="imagenPerfilenModificar" src="../../imagenesGuia/default.jpg">';

                            }

                            ?>
                    </div>
                
                <form method="POST" id="formulario">
                    <input type="hidden" name="guia" id="guia" value='<?=$pasarGuia?>'>
                        <label for="pass " class="col-md-8 offset-2 col-form-label ">Codigo</label>
                        <div class="col-md-8 offset-2">
                            <p><?=$guia[0]['idGuia']?></p>
                            <input type="hidden" name="codigo" id="codigo" value="<?=$guia[0]['idGuia']?>">
                        </div>
                    </div>


                    <div class="form-group row ">
                        <label for="pass " class="col-md-8 offset-2 col-form-label ">Nick</label>
                        <div class="col-md-8 offset-2">
                            <input type="text" class="form-control" require name="nick" id="nick"
                                value="<?=$guia[0]['nick']?>">

                        </div>
                    </div>
                    <div class="row">
                        <div id="errorNick" class="col-md-6 offset-3"></div>
                    </div>

                    <div class="form-group row ">
                        <label for="pass " class="col-md-8 offset-2 col-form-label ">Contraseña</label>
                        <div class="col-md-8 offset-2">
                            <input type="text" class="form-control" require name="pass" id="pass"
                                value="<?=$guia[0]['contrasenya']?>">
                        </div>
                    </div>
                    <div class="row">
                        <div id="errorPass" class="offset-md-3 col-md-6"></div>
                    </div>

                    <div class="form-group row ">
                        <label for="pass " class="col-md-8 offset-2 col-form-label ">DNI</label>
                        <div class="col-md-8 offset-2">
                            <input type="text" class="form-control" require name="dni" id="dni"
                                value="<?=$guia[0]['DNI']?>">
                        </div>
                    </div>
                    <div class="row">
                        <div id="errorDNI" class="col-md-6 offset-3"></div>
                    </div>

                    <div class="form-group row ">
                        <label for="pass " class="col-md-8 offset-2 col-form-label ">Email</label>
                        <div class="col-md-8 offset-2">
                            <input type="email" class="form-control" require name="email" id="email"
                                value="<?=$guia[0]['email']?>">
                        </div>
                    </div>

                    <div class="row">
                        <div id="errorEmail" class="offset-md-3 col-md-6"></div>
                    </div>

                    <div class="form-group row ">
                        <label for="pass " class="col-md-8 offset-2 col-form-label ">Telefono</label>
                        <div class="col-md-8 offset-2">
                            <input type="tel" class="form-control" require name="telefono" id="telefono"
                                value="<?=$guia[0]['telefono']?>">
                        </div>
                    </div>
                    <div class="row">
                        <div id="errorTel" class="offset-md-3 col-md-6"></div>
                    </div>

                    <div class="form-group row ">
                        <?php
                                for($i=1; $i<=3; $i++){
                            
                        echo '<label for="idioma'. $i.'" class="col-md-8 offset-2 col-form-label ">Idioma'. $i . '</label>'.
                        '<div class="col-md-8 offset-2">'.
                            '<select name="idioma'.$i .'" id="idioma'. $i. '">';
                            ?>
                        <option value="ingles" <?=($guia[0]['idioma'.$i] == 'ingles') ? 'selected' : ''?>>Ingles
                        </option>
                        <option value="espanyol" <?=($guia[0]['idioma'.$i] == 'espanyol') ? 'selected' : ''?>>
                            Español</option>
                        <option value="aleman" <?=($guia[0]['idioma'.$i] == 'aleman') ? 'selected' : ''?>>Aleman
                        </option>
                        <option value="frances" <?=($guia[0]['idioma'.$i] == 'frances') ? 'selected' : ''?>>
                            Frances</option>
                        <option value="Italiano" <?=($guia[0]['idioma'.$i] == 'italiano') ? 'selected' : ''?>>
                            Italiano</option>
                        </select>
                    </div>

                    <?php }?>
            </div>

            <div class="col-md-2 offset-9">
                <input type="button" id="boton" name="boton" disabled class="btn btn-light" value="Actualizar">
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