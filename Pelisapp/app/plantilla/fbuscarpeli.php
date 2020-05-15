<?php
include_once 'app/config.php';
include_once 'app/modeloPeliDB.php'; 

ob_start();
?>
<center>
<h2> Buscar </h2>

<form name='Buscar' method="POST" action="index.php?orden=Buscar">
<table>

<tr><td> Titulo  </td><td> <input type="radio" name="buscador" value="1"> </td></tr>
<tr><td> Director  </td><td> <input type="radio" name="buscador" id="cbox1" value="2"> </td></tr>
<tr><td> Genero  </td><td> <input type="radio" name="buscador" id="cbox1" value="3"> </td></tr>
<tr><td> <input type="text"  name = "busqueda" > </td></tr>
</table>
<input  class="buscar"  type="button" value=" Volver " size="10" onclick="javascript:window.location='index.php'" >
<input class="buscar2" type="submit" value="Almacenar">
</form>
</center>
<?php 


$contenido = ob_get_clean();
include_once "principal.php";

?>