<?php 

    //Intento de coneccion a servidor de base de datos.
            
    $dbc = @mysqli_connect('localhost', 'root', '', 'programahonor')
            OR die('No se pudo conectar a MySQL: '.mysqli_connect_error());

?>