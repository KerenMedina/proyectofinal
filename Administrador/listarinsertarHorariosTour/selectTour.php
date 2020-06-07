<?php
include_once("../../funciones/base_datos.php");
$conexion=conectar(); // Se conecta con la base de datos.
 //seleccionamos todos los datos que hay en datos
$sql="SELECT * FROM tour";
$sentencia = $conexion->prepare($sql);
$sentencia->execute();
$tours = $sentencia->fetchAll(PDO::FETCH_ASSOC);


echo "<select id='select_tour' class='t form-control col-2' style='margin-top:10px'>";
echo "<option value='-1'>Elije Tour </option>";

foreach ($tours as $indice =>$tour){
    $cod = $tour['idTour'];
	$nick= $tour["titulo"];
	echo "<option value='$cod'>$cod - $nick </option>";
}
echo "</select>";
$conexion=null;
?>