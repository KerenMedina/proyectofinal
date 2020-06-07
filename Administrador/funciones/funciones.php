<?php
function cabecera()
{ 
    ?>
<nav class="navbar navbar-expand-lg navbar fixed-top" style="background-color: rgba(240, 240, 240, 0.808);">

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                <a href="../principal/pagPrincipal.php"><img id="logo" src="../../imagenes/logo-normal.png"></a>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Clientes
                  </a>
                        <div class="dropdown-menu menu1" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="../insertarCliente/añadirCliente.php">Añadir</a>
                            <a class="dropdown-item" href="../listarClientes/listarClientes.php">Modificar</a>
                        </div>
                    </li>
                    <li> </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Tour
                  </a>
                        <div class="dropdown-menu menu2" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="../insertarTour/añadirTour.php">Añadir</a>
                            <a class="dropdown-item" href="../listarinsertarHorariosTour/listarHorariosTour.php">Añadir Horarios</a>
                            <a class="dropdown-item" href="../listarTours/listarTours.php">Modificar</a>
                            
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown3" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Guías turisticos
                  </a>
                        <div class="dropdown-menu menu3" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="../insertarGuia/añadirGuia.php">Añadir</a>
                            <a class="dropdown-item" href="../listarGuias/listarGuias.php">Modificar</a>
                            
                        </div>
                    </li>
                </ul>
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
