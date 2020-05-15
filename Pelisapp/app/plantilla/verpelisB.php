<?php
include_once 'app/Pelicula.php';
// Guardo la salida en un buffer(en memoria)
// No se envia al navegador
ob_start();
$auto = $_SERVER['PHP_SELF'];

?>


<table>
<th>Código</th><th>Nombre</th><th>Director</th><th>Genero</th>
<?php foreach ($peliculas as $peli) : ?>
<tr>		
<td><?= $peli->codigo_pelicula ?></td>
<td><?= $peli->nombre ?></td>
<td><?= $peli->director ?></td>
<td><?= $peli->genero ?></td>
</tr>
<?php endforeach; ?>
</table>
<br>
<form name='f2' action='index.php'>
<input type='hidden' name='orden' value='Alta'> 
<input type='submit' value='Nueva Película' >
</form>
<form name='f2' action='index.php'>
<input type='hidden' name='orden' value='Buscar'> 
<input type='submit' value='buscar Película' >
</form>
<input type="button" value=" Volver " size="10" onclick="javascript:window.location='index.php'" >
<?php
// Vacio el bufer y lo copio a contenido
// Para que se muestre en div de contenido de la página principal
$contenido = ob_get_clean();
include_once "principal.php";

?>