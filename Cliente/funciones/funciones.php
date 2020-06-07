<?php
function cabecera()
{ 
include_once("../../funciones/base_datos.php");
$conexion = conectar();

    ?>
<nav class="navbar navbar-expand-lg navbar fixed-top" style="background-color: rgba(240, 240, 240, 0.808);">

    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <a href="../principal/pagPrincipal.php"><img id="logo" src="../../imagenes/logo-normal.png"></a>

        <a class="nav-link" href="../tours/verTodos.php">
            Tours
        </a>
        <a class="nav-link" href="../verReservas/verReservas.php">
            Reservas
        </a>
        <a class="nav-link" href="../verReservasPersonalizadas/verPersonalizadas.php">
            Reservas personalizadas
        </a>

    </div>
    <div class="row justify-content-center">
        <div class="col">
            <form action="../verPerfil/verPerfil.php" method="POST">
                <?php
                            if (isset($_SESSION['usuario'])) {
                                $usuario = $_SESSION['usuario'];
                                $sql="SELECT imagen FROM clientes WHERE nick = :nick";
                                $sentencia = $conexion->prepare($sql);
                                $sentencia->execute([":nick" => $usuario]);
                                $cliente = $sentencia->fetchAll(PDO::FETCH_ASSOC);
                                
                                if ($cliente[0]['imagen'] != "") {
                                    ?>
                <input type="image" src="../../imagenesCliente/<?=$cliente[0]['imagen']?>" id="imagenPerfil" name="imagenPerfil"
                    style="height:50px; width:50px; margin-right:10px; border-radius: 50%;">
                    <?php
                                } else { ?>
                        <input type="image" src="../../imagenesCliente/default.jpg" id="imagenPerfil" name="imagenPerfil"
                    style="height:50px; width:50px; margin-right:10px; border-radius: 50%;">
                    <?php }
                            } ?>
            </form>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col">
            <input type="submit" class="btn btn-primary" id="logout" name="logout" value="Logout">
        </div>
    </div>
</nav>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script src="../funciones/scriptMenu.js"></script>
<script src="../logout/logout.js"></script>

<?php
}