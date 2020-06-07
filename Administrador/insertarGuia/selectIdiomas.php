<?php
$contador=$_REQUEST['contador'];
$atributo;

if($contador == 1){
    $atributo= "idioma2";

}else if($contador == 2){
    $atributo= "idioma3";
}
?>
<label for="<?=$atributo?>" class="col-md-11 col-form-label i"><?=$atributo?></label>
<select name="<?=$atributo?>" id="<?=$atributo?>">
    <option value="ingles">Ingles</option>
    <option value="espanyol">Español</option>
    <option value="aleman">Aleman</option>
    <option value="frances">Frances</option>
    <option value="Italiano">Italiano</option>
</select>
</div>