<?php

// Guardo la salida en un buffer(en memoria)
// No se envia al navegador
ob_start();
?>
<center>
<div id='aviso'><b><?= (isset($msg))?$msg:"" ?></b></div>
<form name='ALTA' enctype="multipart/form-data" method="POST" action="index.php?orden=Alta">
<table>
<tr><td>Nombre     :</td><td> <input type="text" name="nombre" value=""></td></tr>
<tr><td>director :</td><td> <input type="text" id="director" name="director" value=""></td></tr>
<tr><td>genero : </td><td><input type="text"    name="genero" value = "" ></td></tr>
<tr><td>imagen : </td><td><input type="file"    name="archivo" value = "" ></td></tr>
<tr><td>trailer : </td><td><input type="text"    name="trailer" value = "" ></td></tr>
</table>

<br>
	
	<input type="hidden" name="MAX_FILE_SIZE" value="100000" />
	<input class="buscar" type="submit" value="Almacenar">
	<input  class="buscar2" type="cancel" value="Cancelar" size="10" onclick="javascript:window.location='index.php'" >
</form>
</center>
<?php 
// Vacio el bufer y lo copio a contenido
// Para que se muestre en div de contenido
$contenido = ob_get_clean();
include_once "principal.php";

?>