<!DOCTYPE html>
<html>
    
<head>
    <meta charset="utf-8">
    <title>Programa de Honor UPRA</title>
    <link href="https://fonts.googleapis.com/css?family=Source+Code+Pro&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>
<div id="container">
<?php
//Conexión a la base de datos por archivo externo.

include_once('conectiondb.php');
//include_once('localhostdb.php');

$query = "SELECT e.est_id, e.nombre, e.apellido1, e.apellido2, e.email, d.nombre departamento, e.promedio
FROM estudiante2 e, departamento d
WHERE e.depto_id = d.depto_id
ORDER BY promedio DESC";

if($r = mysqli_query($dbc, $query))
{
    print"<div><center><table id='table1'>";
    print"<h2>Estudiantes de Honor</h2>";
    print"<h3>Plataforma para ver y eliminar estudiantes de honor (GPA > 3.5)</h3>";
    print"<tr id='table_header'>
            <td><b>Nombre</b></td>
            <td><b>Apellido Paterno</b></td>
            <td><b>Apellido Materno</b></td>
            <td><b>E-mail</b></td>
            <td><b>Departamento</b></td>
            <td><b>Promedio</b></td>
            </tr>";

    while($row=mysqli_fetch_array($r))
    {
        print"<tr id='table_rows'>
            <td>$row[nombre]</td>
            <td>$row[apellido1]</td>
            <td>$row[apellido2]</td>
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