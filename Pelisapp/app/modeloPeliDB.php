<?php

include_once 'config.php';
include_once 'Pelicula.php';

class ModeloUserDB {

     private static $dbh = null; 
     private static $consulta_peli = "Select * from peliculas where codigo_pelicula = ?";
     private static $buscarN_peli =  "Select * from peliculas where nombre = ? ";
     private static $buscarD_peli =  "Select * from peliculas where director = ? ";
     private static $buscarG_peli =  "Select * from peliculas where genero = ? ";
     private static $update_peli   = "UPDATE peliculas set  codigo_pelicula=?, nombre =?, ".
     "director=?, genero=?, imagen=? where codigo_pelicula = ? ";
     private static $insert_peli   = "Insert into peliculas (nombre,director,genero,imagen,trailer)".
     " VALUES (?,?,?,?,?)";
     private static $delete_peli   = "Delete from peliculas where codigo_pelicula = ?"; 
  /*
   


   
 */    
     
public static function init(){
   
    if (self::$dbh == null){
        try {
            // Cambiar  los valores de las constantes en config.php
            $dsn = "mysql:host=".DBSERVER.";dbname=".DBNAME.";charset=utf8";
            self::$dbh = new PDO($dsn,DBUSER,DBPASSWORD);
            // Si se produce un error se genera una excepción;
            self::$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            echo "Error de conexión ".$e->getMessage();
            exit();
        }
        
    }
    
}


public static function UserAdd($nuevo):bool{
    $stmt = self::$dbh->prepare(self::$insert_peli);
    $stmt->bindValue(1,$nuevo[0] );
    $stmt->bindValue(2,$nuevo[1] );
    $stmt->bindValue(3,$nuevo[2] );
    $stmt->bindValue(4,$nuevo[3] );
    $stmt->bindValue(5,$nuevo[4] );

    if ($stmt->execute()){
       return true;
    }
    return false; 
}



public static function UserDel($pelicula_borrar){
    $stmt = self::$dbh->prepare(self::$delete_peli);
    $stmt->bindValue(1,$pelicula_borrar);
    $stmt->execute();
    if ($stmt->rowCount() > 0 ){
        return true;
    }
    return false;
}

/***
//


// Actualizar un nuevo usuario (boolean)
// GUARDAR LA CLAVE CIFRADA
public static function UserUpdate ($userid, $userdat){
    $clave = $userdat[0];
    // Si no tiene valor la cambio
    if ($clave == ""){ 
        $stmt = self::$dbh->prepare(self::$update_usernopw);
        $stmt->bindValue(1,$userdat[1] );
        $stmt->bindValue(2,$userdat[2] );
        $stmt->bindValue(3,$userdat[3] );
        $stmt->bindValue(4,$userdat[4] );
        $stmt->bindValue(5,$userid);
        if ($stmt->execute ()){
            return true;
        }
    } else {
        $clave = Cifrador::cifrar($clave);
        $stmt = self::$dbh->prepare(self::$update_user);
        $stmt->bindValue(1,$clave );
        $stmt->bindValue(2,$userdat[1] );
        $stmt->bindValue(3,$userdat[2] );
        $stmt->bindValue(4,$userdat[3] );
        $stmt->bindValue(5,$userdat[4] );
        $stmt->bindValue(6,$userid);
        if ($stmt->execute ()){
            return true;
        }
    }
    return false; 
}
****/

// Tabla de objetos con todas las peliculas
public static function GetAll ():array{
    // Genero los datos para la vista que no muestra la contraseña
    
    $stmt = self::$dbh->query("select * from peliculas");
    
    $tpelis = [];
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Pelicula');
    while ( $peli = $stmt->fetch()){
        $tpelis[] = $peli;       
    }
    return $tpelis;
}



public static function UserBusN ($buscar){
 
    $stmt = self::$dbh->prepare(self::$buscarN_peli);
    $stmt->bindValue(1,$buscar);
    $stmt->execute();
    $tpelis = [];
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Pelicula');
    while ( $peli = $stmt->fetch()){
        $tpelis[] = $peli;       
    }
    
    return $tpelis;
}


public static function UserBusD ($buscar){
 
    $stmt = self::$dbh->prepare(self::$buscarD_peli);
    $stmt->bindValue(1,$buscar);
    $stmt->execute();
    $tpelis = [];
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Pelicula');
    while ( $peli = $stmt->fetch()){
        $tpelis[] = $peli;       
    }
    
    return $tpelis;
}
public static function UserBusG ($buscar){
 
    $stmt = self::$dbh->prepare(self::$buscarG_peli);
    $stmt->bindValue(1,$buscar);
    $stmt->execute();
    $tpelis = [];
    $stmt->setFetchMode(PDO::FETCH_CLASS, 'Pelicula');
    while ( $peli = $stmt->fetch()){
        $tpelis[] = $peli;       
    }
    
    return $tpelis;
}




// Datos de una película para visualizar
public static function UserGet ($codigo){
    $datospeli = [];
    $stmt = self::$dbh->prepare(self::$consulta_peli);
    $stmt->bindValue(1,$codigo);
    $stmt->execute();
    if ($stmt->rowCount() > 0 ){
        // Obtengo un objeto de tipo Usuario, pero devuelvo una tabla
        // Para no tener que modificar el controlador
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Pelicula');
        $uobj = $stmt->fetch();
        $datospeli = [ 
                     $uobj->codigo_pelicula,
                     $uobj->nombre,
                     $uobj->director,
                     $uobj->genero,
                     $uobj->imagen,
                     $uobj->trailer
                     ];
        return $datospeli;
    }
    
    return $datospeli;
}

//------------------FICHEROS

function imgAdd($nombreArchivo,$tmpArchivo){
    $rutaDestino = "./app/img/". $nombreArchivo;
    

    return $archivoOk;

}




public static function closeDB(){
    self::$dbh = null;
}

} // class
