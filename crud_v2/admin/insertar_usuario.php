<!DOCTYPE html>
<?php
    //Conexion a base de datos.
    include('../conectiondb.php');
//    include('../localhostdb.php');
//Empezar session.
session_start();
?>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Insertar Usuario</title> 
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
    
if (isset($_POST['submit']))
{
	$email = $_POST['email'];
    $password = $_POST['password'];
    $telefono = $_POST['telefono']; 
    $status = "activo";
    
    $query = "SELECT * FROM estudiante2 WHERE email = '$email'";
    $r = mysqli_query($dbc, $query);
    
    if ($row = mysqli_fetch_array($r))
    {
        if ( (strtolower($_POST['email']) == $row['email']) )
        { // El usuario existe en la tabla de estudiante2.

            //Query para insertar usuario.
            $query2 = "INSERT INTO usuarios2
                        (email, pass, telefono, status)
                        VALUES ('".$email."', '".$password."', '".$telefono."', '".$status."')";
            echo "<p>$query2</p>";
            $r = mysqli_query($dbc,$query2);

            if(mysqli_affected_rows($dbc) == 1)
               print '<h3>El estudiante ha sido insertado con éxito.</h3>';
            else
               print '<p style="color:red;">No se pudo insertar al estudiante porque:<br />' . mysqli_error($dbc) . '</p>';   
            mysqli_close($dbc);
        }
    }
}
?>

<center>
<h2>Insertar Usuario</h2>
<p><span class="error">* campo requerido</span></p>
<form id='form1' name='form1' method='POST' action='insertar_usuario.php'>
  <table id='table2'width='349' border='0'>
        <tr>
          <td align='right'>E-mail</td>
          <td align='left'><label for="email"></label>
          <input type="email" name="email" id="email" required/>
          <span class="error">*</span>
          </td>
        </tr>
        
        <tr>
          <td align="right"><label for="password">Password: </label></td>
          <td align="left">
          <input type="password" name="password" id="password" required/> 
          <span class="error">*</span>
          </td>
        </tr>
        
        <tr>
          <td align="right"><label for="telefono">Teléfono: </label></td>
          <td align="left">
          <input type="tel" name="telefono" id="telefono"/> 
          </td>
        </tr>
        
    <tr>
      <td colspan='2' align='center'><input type='submit' name='submit' id='submit' value='Insertar'/></td>
      </tr>
  </table>
</form>
<br>
<button><a href='cuentas_usuarios.php' id='botton'> Ver Usuarios </a></button>
<br>
</center>
</div>
</body>
</html>