<?php
// ------------------------------------------------
// Controlador que realiza la gestión de usuarios
// ------------------------------------------------

include_once 'config.php';
include_once 'modeloPeliDB.php';


/**********
/*
 * Inicio Muestra o procesa el formulario (POST)
 */

function ctFileSubirFicheros(){

    $peli="";

    $codigosErrorSubida= [ 
        0 => 'Subida correcta',
        1 => 'El tamaño del archivo excede el admitido por el servidor',  // directiva upload_max_filesize en php.ini
        2 => 'El tamaño del archivo excede el admitido por el cliente',  // directiva MAX_FILE_SIZE en el formulario HTML
        3 => 'El archivo no se pudo subir completamente',
        4 => 'No se seleccionó ningún archivo para ser subido',
        6 => 'No existe un directorio temporal donde subir el archivo',
        7 => 'No se pudo guardar el archivo en disco',  // permisos
        8 => 'Una extensión PHP evito la subida del archivo'  // extensión PHP
    ]; 
   
    
    // si no se reciben el directorio de alojamiento y el archivo, se descarta el proceso
    if ((! isset($_FILES['archivo']['name']))) {
       

    } else 
        { // se reciben el directorio de alojamiento y el archivo
        $directorioSubida = "app/img"; // debe permitir la escritua para Apache
        // Información sobre el archivo subido
        $nombreFichero   =   $_FILES['archivo']['name'];
        $tipoFichero     =   $_FILES['archivo']['type'];
        $tamanioFichero  =   $_FILES['archivo']['size'];
        $temporalFichero =   $_FILES['archivo']['tmp_name'];
        $errorFichero    =   $_FILES['archivo']['error'];
    
    
    
        // Obtengo el código de error de la operación, 0 si todo ha ido bien
        if ($tamanioFichero > 100000) {
            
            $peli=1;
         
            
           
        } else { // subida correcta del temporal
            // si es un directorio y tengo permisos     
             if ( is_dir($directorioSubida) && is_writable ($directorioSubida)) { 
                //Intento mover el archivo temporal al directorio indicado
                if (move_uploaded_file($temporalFichero,  $directorioSubida .'/'. $nombreFichero) == true) {
                   
                } 
            } 
        }
    }

    return $peli;
}



