<?php
/*
	CLASE CONEXIÓN BASE DE DATOS
*/
    // Datos de la base de datos
    define('SERVERNAME', 'localhost');
    define('USERNAME', 'root');
    define('PASSWORD', '');
    define('DBNAME', 'proyecto');
    
    // creación de la conexión a la base de datos con mysql_connect()
    $conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DBNAME);

    //Controlar la conexión
    if($conn -> connect_error){
        die('Conexión fallida: ' . $conn -> connect_error);
    }
    
?>