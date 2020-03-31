<?php 

    $host = '136.145.29.193';
    $username = 'alezenmi';
    $password = 'alezenmi840$cuta';
    db = 'alezenmi_db';
    //Intento de coneccion a servidor de base de datos.
            
    $dbc = @mysqli_connect('localhost', 'root', '', 'programahonor')
            OR die('No se pudo conectar a MySQL: '.mysqli_connect_error());

?>