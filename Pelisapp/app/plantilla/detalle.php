<?php
include_once 'app/config.php';
include_once 'app/modeloPeliDB.php'; 

ob_start();
?>

<center>

<h2> Detalles </h2>


<iframe width="100%" height="400" src="<?= $trailer ?>" frameborder="0">  </iframe>
</center>
<table>
<tr><td>codigo_pelicula   </td><td> <?= $clave ?></td></tr>
<tr><td>Nombre   </td><td>   <?= $nombre ?></td></tr>
<tr><td> director </td><td>     <?= $director ?></td></tr>
<tr><td>genero    </td><td>    <?= $genero  ?></td></tr>

</table>
<img  id="imagen" src="app/img/<?=$imagen?>" height="100px" width="100px" >

<center>
<input class="boton3d" type="button" value=" Volver " size="10" onclick="javascript:window.location='index.php'" >
</center>
<?php 


$contenido = ob_get_clean();
include_once "principal.php";

?>