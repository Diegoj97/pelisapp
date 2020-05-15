<?php
// ------------------------------------------------
// Controlador que realiza la gestión de usuarios
// ------------------------------------------------

include_once 'config.php';
include_once 'modeloPeliDB.php'; 
include_once 'app/controlerFile.php';

/**********
/*
 * Inicio Muestra o procesa el formulario (POST)
 */

function  ctlPeliInicio(){
   }

/*
 *  Muestra y procesa el formulario de alta 
 */

function ctlPeliAlta (){


    $peli=0;

    ctFileSubirFicheros();
    $peli = ctFileSubirFicheros();

    if($peli==0){

   
   
    $nombre = "";
    $director = "";
    $genero = "";
    $imagen = "";
    $trailer = "";
  

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if ( isset($_POST['nombre']) && isset($_POST['director']) && isset($_POST['genero']) && isset($_POST['trailer'])) {

            $nombre = htmlspecialchars($_POST['nombre']);
            $director = htmlspecialchars($_POST['director']);
            $genero= htmlspecialchars($_POST['genero']);
            $imagen = $_FILES['archivo']['name'];
            $trailer = htmlspecialchars($_POST['trailer']);
           
            
            $nuevo = [
               
                $nombre,
                $director,
                $genero,
                $imagen,
                $trailer
               
            ];
       

        }
       
     
        modeloUserDB::UserAdd($nuevo);
        modeloUserDB::GetAll();
     


        header('Location:index.php?orden=VerPelis');
        

    } else {
        include_once 'plantilla/fnuevo.php';
    }

}else{
    include_once 'plantilla/fnuevo.php';
}


}







/*
 *  Muestra y procesa el formulario de Modificación 
 */
function ctlPeliBuscar (){

    $buscador="";
  
  
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        $buscador = $_POST['buscador'];

    Switch( $buscador )
    {
      case 1: 

        if (isset($_POST['busqueda'])) {
            $busqueda = $_POST['busqueda'];
           
            $peliculas=modeloUserDB::UserBusN($busqueda);
           
        }
        include_once 'plantilla/verpelisB.php';
      break;
      case 2: 

        if (isset($_POST['busqueda'])) {
            $busqueda = $_POST['busqueda'];
           
            $peliculas=modeloUserDB::UserBusD($busqueda);
           
        }
        include_once 'plantilla/verpelisB.php';
      break;
     

      case 3: 

        if (isset($_POST['busqueda'])) {
            $busqueda = $_POST['busqueda'];
           
            $peliculas=modeloUserDB::UserBusG($busqueda);
           
        }
        include_once 'plantilla/verpelisB.php';
      break;


    }

     
} else {
    include_once 'plantilla/fbuscarpeli.php';
}


}


/*
 *  Muestra detalles de la pelicula
 */

function ctlPeliDetalles(){

        $clave=$_GET['codigo'];
        $listadetalles = ModeloUserDB::UserGet($clave);
        $nombre=$listadetalles[1];
        $director=$listadetalles[2];
        $genero=$listadetalles[3];
        $imagen=$listadetalles[4];
        $trailer=$listadetalles[5];
       
        if (!$listadetalles[4]){

                $imagen="fuera.png";

        }
        include_once 'plantilla/detalle.php'; 
    
    
    
}
/*
 * Borrar Peliculas
 */

function ctlPeliBorrar(){

    $pelicula_borrar = $_GET['userid'];
    modeloUserDB::UserDel($pelicula_borrar);
    modeloUserDB::GetAll();
    header('Location:index.php?orden=VerPelis');

    
}

/*
 * Cierra la sesión y vuelca los datos
 */
function ctlPeliCerrar(){
    session_destroy();
    modeloUserDB::closeDB();
    header('Location:index.php');
}

/*
 * Muestro la tabla con los usuario 
 */ 
function ctlPeliVerPelis (){
    // Obtengo los datos del modelo
    $peliculas = ModeloUserDB::GetAll(); 
    // Invoco la vista 
    include_once 'plantilla/verpeliculas.php';
   
}
