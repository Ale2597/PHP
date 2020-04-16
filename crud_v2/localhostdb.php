<?php 

    //Intento de coneccion a servidor de base de datos.

    $host = 'localhost';
    $username = 'root';
    $password = '';
    $db = 'programahonor';
            
    $dbc = @mysqli_connect($host, $username, $password, $db)
            OR die('No se pudo conectar a MySQL: '.mysqli_connect_error());

    mysqli_set_charset($dbc, 'utf8');

?>