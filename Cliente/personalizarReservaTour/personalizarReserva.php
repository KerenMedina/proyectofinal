<?php
include_once("../funciones/funciones.php");
include_once("../../funciones/base_datos.php");

session_start();
$conexion = conectar();

$idTour=$_REQUEST['idTour'];

$sql="SELECT * FROM tour WHERE idTour = :idTour";
$sentencia = $conexion->prepare($sql);
$sentencia->execute(["idTour" => $idTour]);
$tour = $sentencia->fetchAll(PDO::FETCH_ASSOC);

$sql="SELECT * FROM horarios WHERE idTour = :idTour";
$sentencia = $conexion->prepare($sql);
$sentencia->execute(["idTour" => $idTour]);
$horarios = $sentencia->fetchAll(PDO::FETCH_ASSOC);

$sql="SELECT * FROM guias";
$sentencia = $conexion->prepare($sql);
$sentencia->execute();
$guias = $sentencia->fetchAll(PDO::FETCH_ASSOC);

$nickUsu = $_SESSION['usuario'];
$sql="SELECT idCliente FROM clientes WHERE nick = :nick";
$sentencia = $conexion->prepare($sql);
$sentencia->execute(["nick" => $nickUsu]);
$clientes = $sentencia->fetchAll(PDO::FETCH_ASSOC);

$cantHorarios = count($horarios);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Personalizar tour</title>
    <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../bootstrap/micss.css" rel="stylesheet">
</head>

<body>
    <?=cabecera();?>
    <div class="container col-12 align-items-center pagina">
        <div class="col-10 offset-1 formAñadirCliente">
            <div>
                <h1 style="color:cornflowerblue; text-align:center; margin-bottom:3%">Personalizar tour:
                    <?=$tour[0]['titulo']?></h1>
                <div style="height:125px; width:1000px">
                    <label for="horarioPers" class="col-md-8 offset-2 col-form-label ">Horario</label>
                    <div class="col-md-8 offset-2">
                        <input type="datetime-local" class="form-control h" name="horarioPers" id="horarioPers">
                    </div>
                </div>
            </div>
            <div style="position:relative; width:50%; padding:5%; float:left">
                <select id='select_idioma' class='form-control col-5 offset-3' style='margin-top:10px'>
                    <option value='-1'>Elije idioma </option>
                    <option value='ingles'>Ingles </option>
                    <option value='espanyol'>Español </option>
                    <option value='aleman'>Aleman </option>
                    <option value='frances'>Frances </option>
                    <option value='italiano'>Italiano </option>

                </select>
            </div>

            <div id="contenidoSelect" class="col-7 offset-7" style="background-color:; position:relative; width:50%; padding:5%">
                
            </div>

            <div class="offset-10">
                <input type="button" class="btn btn-light" disabled name="confirmarReserva" id="confirmarReserva"
                    value="Confirmar Reserva">
                <input type="hidden" name="idTour" id="idTour" value="<?=$idTour?>">
                <input type="hidden" name="idCliente" id="idCliente" value="<?=$clientes[0]['idCliente']?>">
            </div>
        </div>
    </div>

    </div>
    </div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="personalizar.js"></script>


</html>