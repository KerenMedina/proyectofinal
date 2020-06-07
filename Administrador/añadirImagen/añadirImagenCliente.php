<?php
include_once("../funciones/funciones.php");
include_once("../../funciones/base_datos.php");
session_start();

if($_SESSION['usuario']){
    $conexion=conectar();

    $idCliente=$_REQUEST['codigoClienteImagen'];

    if (isset($_FILES['imagenPerfil'])) {
        $nombreImagen = $idCliente . ".png";
        $subido = "imagenPerfil";

        $imagen = $_FILES[$subido]["tmp_name"];
        $destino = "../../imagenesCliente/" . $nombreImagen;

        if (move_uploaded_file($imagen, $destino)) {
            $sentencia = $conexion->prepare("UPDATE clientes SET imagen = :imagen WHERE idCliente= :cod ");
            $resultado = $sentencia->execute([":imagen" => $nombreImagen, ":cod"=>$idCliente]);
            header ("Location: ../listarClientes/listarClientes.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Seleccionar imagen</title>
    <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../bootstrap/micss.css" rel="stylesheet">
</head>

<body>
    <?=cabecera();?>
    <div class="container col-12 align-items-center pagina">
        <div class="col-12 ">
            <div class="col-10 offset-md-1 formAñadirCliente">
                <h2 class="offset-2 col-md-8" style="background-color:#6495ed89; border-radius: 5px;">Seleccionar foto
                    de perfil cliente <?=$idCliente?></h2>
                <br>
                <form name="subir" method="post" enctype="multipart/form-data">
                    <div class="form-group row ">
                        <div class="col-md-8 offset-2">
                            <input type="file" name="imagenPerfil"><br><br>
                            <input type="hidden" name="codigoClienteImagen" value="<?= $idCliente ?>">
                            <input type="submit" class="btn btn-primary" value="Subir imagen">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>


</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="listarGuias.js"></script>

</html>


<?php
}else{
    header ("Location: ../../login/login.html");
}

?>