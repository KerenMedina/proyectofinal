<?php
session_start();


if(isset($_SESSION['usuario'])){

    $_SESSION = array ();
    session_destroy();
    $mensaje['logout']=true;

}else{
    $mensaje['logout']=false;
}


echo json_encode($mensaje);




