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

$sql="SELECT * FROM tourguia WHERE idTour = :idTour";
$sentencia = $conexion->prepare($sql);
$sentencia->execute(["idTour" => $idTour]);
$guiasTour = $sentencia->fetchAll(PDO::FETCH_ASSOC);

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
    <title>Reservar tour</title>
    <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../bootstrap/micss.css" rel="stylesheet">
</head>

<body>
    <?=cabecera();?>
    <div class="container col-12 align-items-center pagina">
        <div class="col-10 offset-1 formAñadirCliente">
            <div>
                <h1 style="color:cornflowerblue; text-align:center; margin-bottom:3%"><?=$tour[0]['titulo']?></h1>
                <div style="height:125px; width:1000px">
                    <?php
                            for ($i = 0; $i<$cantHorarios; $i++) {
                                ?>
                    <div style="float:left; padding:5%;">
                        <h4>
                            <input type="radio" name="horario" id="horario<?=$i+1?>"
                                value="<?=$horarios[$i]['idHorario']?>">
                            Horario <?=$i+1?></h4>
                        <p><?=$horarios[$i]['horario']?></p>
                    </div>

                    <?php
                            }?>
                </div>
                <div style="background-color:; position:relative; width:100%; padding:5%">
                    <select id='select_guia' class='g form-control col-2' style='margin-top:10px'>
                        <option value='-1'>Elije guia </option>

                        <?php
                            foreach ($guiasTour as $indice =>$guiaTour){
                                $sql="SELECT * FROM guias WHERE idGuia = :idGuia";
                                $sentencia = $conexion->prepare($sql);
                                $sentencia->execute(["idGuia" => $guiaTour['idGuia']]);
                                $guias = $sentencia->fetchAll(PDO::FETCH_ASSOC);

                                foreach ($guias as $guia) {
                                    $cod = $guia['idGuia'];
                                    $nick= $guia["nick"];
                                    echo "<option value='$cod'>$cod - $nick </option>";
                                }
                            }?>

                    </select>
                </div>
                <div class="row">
                    <div class="col-2">
                        <form action="../personalizarReservaTour/personalizarReserva.php" method="POST">
                            <input type="submit" class="btn btn-primary" name="personalizarReserva"
                                id="personalizarReserva" value="Personalizar Tour">
                            <input type="hidden" name="idTour" id="idTour" value="<?=$idTour?>">
                        </form>
                    </div>
                    <div class="offset-8">
                        <input type="button" class="btn btn-light" disabled name="confirmarReserva"
                            id="confirmarReserva" value="Confirmar Reserva">
                        <input type="hidden" name="idTour" id="idTour" value="<?=$idTour?>">
                        <input type="hidden" name="idCliente" id="idCliente" value="<?=$clientes[0]['idCliente']?>">
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="reserva.js"></script>


</html>