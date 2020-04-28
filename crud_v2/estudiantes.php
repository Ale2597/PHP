<!DOCTYPE html>
<?php 
//Conexión a la base de datos por archivo externo.

include('conectiondb.php');
//include('localhostdb.php');

?>
<html>   
<head>
    <meta charset="utf-8">
    <title>Programa de Honor UPRA (Visitante)</title>
    <link href="https://fonts.googleapis.com/css?family=Source+Code+Pro&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>
<div id="container">
<?php

print '<div id="window">
            <div id="profile">
                <h3> Bienvenido Visitante! </h3>
                <h4 style="text-align: center;"><a href="index.php">Login</a></h4>
            </div>
       </div>';

//Determinar columna para ordenar.
if(isset($_GET['orden']))
    $orden=$_GET['orden'];
else
    $orden = 'p';
    
switch($orden)
{
    case 'a': $order_by = 'apellido1, apellido2, nombre ASC';
        break;
        
    case 'p': $order_by = 'promedio DESC';
        break;
        
    case 'e': $order_by = 'email ASC';
        break;
        
    case 'd': $order_by = 'departamento ASC';
        break;
        
    default: $order_by = 'promedio DESC';
}

$query = "SELECT e.est_id, e.nombre, e.apellido1, e.apellido2, e.email, d.nombre departamento, e.promedio
FROM estudiante2 e, departamento d
WHERE e.depto_id = d.depto_id
ORDER BY $order_by";

if($r = mysqli_query($dbc, $query))
{
    print"<div><center><table id='table1'>";
    print"<h2>Estudiantes de Honor (Visitantes) </h2>";
    print"<h3>Plataforma para ver estudiantes de honor (GPA > 3.5)</h3>";
    print"<tr id='table_header'>
            <td><b><a href='estudiantes.php?orden=a'>Apellido Paterno</a></b></td>
            <td><b>Apellido Materno</b></td>
            <td><b>Nombre</b></td>
            <td><b><a href='estudiantes.php?orden=e'>E-mail</a></b></td>
            <td><b><a href='estudiantes.php?orden=d'>Departamento</a></b></td>
            <td><b><a href='estudiantes.php?orden=p'>Promedio</a></b></td>
            </tr>";

    while($row=mysqli_fetch_array($r))
    {
        print"<tr id='table_rows'>
            <td>$row[apellido1]</td>
            <td>$row[apellido2]</td>
            <td>$row[nombre]</td>
            <td>$row[email]</td>
            <td>$row[departamento]</td>
            <td>$row[promedio]</td>
            </tr>";
    }

    print"</table></center></div><br>";
    
}
else{
    print '<p style="color:red;">No se puede mostrar récords de la base de datos porque: 
    <br/>'.mysqli_error($dbc).'.</p>';

    mysqli_close($dbc);
    }

?>
</div>
</body>
</html>