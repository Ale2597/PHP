<?php 

    //Intento de coneccion a servidor de base de datos.

    $host = '136.145.29.193';
    $username = 'hirverme';
    $password = 'hirverme840$cuta';
    $db = 'hirverme_db';
            
    $dbc = @mysqli_connect($host, $username, $password, $db)
            OR die('No se pudo conectar a MySQL: '.mysqli_connect_error());

    mysqli_set_charset($dbc, 'utf8');

?>