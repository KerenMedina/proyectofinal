<?php
include_once("../../funciones/base_datos.php");
$conexion=conectar(); // Se conecta con la base de datos.
 //seleccionamos todos los datos que hay en datos
$sql="SELECT * FROM clientes";
$sentencia = $conexion->prepare($sql);
$sentencia->execute();
$clientes = $sentencia->fetchAll(PDO::FETCH_ASSOC);


echo "<select id='select_cliente' class='c form-control col-2' style='margin-top:10px'>";
echo "<option value='-1'>Elije cliente </option>";

foreach ($clientes as $indice =>$cliente){
    $cod = $cliente['idCliente'];
	$nick= $cliente["nick"];
	echo "<option value='$cod'>$cod - $nick </option>";
}
echo "</select>";
$conexion=null;
?>