<?php
include_once("../../funciones/base_datos.php");
$conexion=conectar(); // Se conecta con la base de datos.
 //seleccionamos todos los datos que hay en datos
$sql="SELECT * FROM guias";
$sentencia = $conexion->prepare($sql);
$sentencia->execute();
$clientes = $sentencia->fetchAll(PDO::FETCH_ASSOC);


echo "<select id='select_guia' name='idGuia'  class='g form-control col-2' style='margin-top:10px'>";
echo "<option value='-1'>Elije guia </option>";

foreach ($clientes as $indice =>$cliente){
    $cod = $cliente['idGuia'];
	$nick= $cliente["nick"];
	echo "<option value='$cod'>$cod - $nick </option>";
}
echo "</select>";
$conexion=null;
?>