<?php
include_once("../funciones/base_datos.php");
//RECIBIR DATOS
    if (empty($_REQUEST['pass']) || empty($_REQUEST['usu'])) {
        $errores[] = "Debe rellenar los datos";
    }
    
    try{
        $conexion=conectar();
        $usu=$_REQUEST['usuario'];
        $pass= $_REQUEST['pass'];
        $encontrado = false;
        $tipo = $_REQUEST['tipoUsuario'];
        $admin = false;
        $cliente = false;
        $guia = false;

        if ($tipo == "admin") {
            $consulta="SELECT nick, contrasenya FROM admin";
            $admin = true;
            
        }else if($tipo == "cliente"){
            $consulta="SELECT nick, contrasenya FROM clientes";
            $cliente = true;

        }else if($tipo == "guia"){
            $consulta="SELECT nick, contrasenya FROM guias";
            $guia = true;

        }

        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute();
        $usuarios = $sentencia->fetchAll(PDO::FETCH_OBJ);

        if(!$encontrado){
            foreach($usuarios as $usuario){
                if($usuario->nick == $usu && $usuario->contrasenya == $pass){
                    $encontrado=true;
                    $usuarioCorrecto=$usuario->nick;

                    if($admin){
                        $mensajes['admin'] = true;
                        $mensajes['cliente'] = false;
                        $mensajes['guia'] = false;

                    }else if($cliente){
                        $mensajes['cliente'] = true;
                        $mensajes['admin'] = false;
                        $mensajes['guia'] = false;

                    }else if($guia){
                        $mensajes['guia'] = true;
                        $mensajes['admin'] = false;
                        $mensajes['cliente'] = false;
                    }
                }
            }
        }

        if($encontrado){

            $mensajes["login"]=true;
            session_start();
            $_SESSION['usuario'] = $usu;
            echo json_encode($mensajes);
            
        }else{
            $mensajes["login"]=false;
            echo json_encode($mensajes);

        }

        


    }catch(Exception $e){
        echo $e->getMessage();
    }

    
?>