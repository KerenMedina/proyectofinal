<?php
include_once("../../funciones/base_datos.php");
$conexion=conectar(); // Se conecta con la base de datos.
 //seleccionamos todos los datos que hay en datos
$sql="SELECT * FROM tour";
$sentencia = $conexion->prepare($sql);
$sentencia->execute();
$tours = $sentencia->fetchAll(PDO::FETCH_ASSOC);


echo "<select id='select_tour' class='g form-control col-2' style='margin-top:10px'>";
echo "<option value='-1'>Elije tour </option>";

foreach ($tours as $indice =>$tour){
    $cod = $tour['idTour'];
	$titulo= $tour["titulo"];
	echo "<option value='$cod'>$cod - $titulo </option>";
}
echo "</select>";
$conexion=null;
?>