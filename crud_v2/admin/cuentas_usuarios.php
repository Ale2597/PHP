<!DOCTYPE html>
<?php 
//Conexión a la base de datos por archivo externo.

include('../conectiondb.php');
//include('localhostdb.php');

//Empezar session.
session_start();

?>
<html>
<head>
    <meta charset="utf-8">
    <title>Cuentas de Usuarios</title>
    <link href="https://fonts.googleapis.com/css?family=Source+Code+Pro&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../index.css">
</head>
<body>
<div id="container">
<?php
 
print '<div id="window">
            <div id="profile">
                <h3> Bienvenido admin  '. $_SESSION['nombre_admin'].'! </h3>
            </div>
       </div>';

$query = "SELECT *
FROM usuarios2";

if($r = mysqli_query($dbc, $query))
{
    print"<div><center><table id='table1'>";
    print"<h2>Cuentas de Usuarios</h2>";
    print"<tr id='table_header'>
            <td><b>Editar</b></td>
            <td><b>Email</b></td>
            <td><b>Password</b></td>
            <td><b>Teléfono</b></td>
            <td><b>Status</b></td>
            </tr>";

    while($row=mysqli_fetch_array($r))
    {
        print"<tr id='table_rows'>
            <td>
            <a href=\"editar_cuentas_usuarios.php?user_id={$row['user_id']}\"/>Editar</a>
            </td>
            <td>$row[email]</td>
            <td>$row[pass]</td>
            <td>$row[telefono]</td>
            <td>$row[status]</td>
            </tr>";
    }

    print"</table></center></div><br>";
    
    print"<button><a href='index.php' id='botton'> Ver Estudiantes </a></button>";
    print"<button><a href='insertar_usuario.php' id='botton'>Añadir Usuarios</a></button>";
    
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