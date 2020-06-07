<?php
function cabecera()
{ 
include_once("../../funciones/base_datos.php");
$conexion = conectar();

    ?>
<nav class="navbar navbar-expand-lg navbar fixed-top" style="background-color: rgba(240, 240, 240, 0.808);">

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <a href="../principal/pagPrincipal.php"><img id="logo" src="../../imagenes/logo-normal.png"></a>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Reservas
                </a>
                <div class="dropdown-menu menu1" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="../verReservas/verReservas.php">Reservas Confirmadas</a>
                    <a class="dropdown-item" href="../verReservasPersonalizadas/verPersonalizadas.php">Reservas Personalizadas</a>
                </div>
            </li>
            <li> </li>
        </ul>
    </div>
    <div class="row justify-content-center">
        <div class="col">
            <form action="../verPerfil/verPerfil.php" method="POST">
                <?php
                            if (isset($_SESSION['usuario'])) {
                                $usuario = $_SESSION['usuario'];
                                $sql="SELECT imagen FROM guias WHERE nick = :nick";
                                $sentencia = $conexion->prepare($sql);
                                $sentencia->execute([":nick" => $usuario]);
                                $guia = $sentencia->fetchAll(PDO::FETCH_ASSOC);
                                
                                if ($guia[0]['imagen'] != "") {
                                    ?>
                <input type="image" src="../../imagenesGuia/<?=$guia[0]['imagen']?>" id="imagenPerfil"
                    name="imagenPerfil" style="height:50px; width:50px; margin-right:10px; border-radius: 50%;">
                <?php
                                } else { ?>
                <input type="image" src="../../imagenesGuia/default.jpg" id="imagenPerfil" name="imagenPerfil"
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