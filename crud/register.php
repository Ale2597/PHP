<!DOCTYPE html>
<html>
<head>
    <meta charset="big5" />
    <title>REGISTER - Estudiantes de Honor UPRA</title>
    <link href="https://fonts.googleapis.com/css?family=Source+Code+Pro&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="index.css">
</head>

<body>
<!-- 
include_once('conectiondb.php');
include_once('localhostdb.php');-->

    <h2>Programa de Honor </h2>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    if( (!empty($_POST['email'])) && (!empty($_POST['password'])) ) 
    { //conectarme a ver si existe usuario    
        if(include_once('localhostdb.php')) // Conectarse al servidor SQL
        {
            $email = $_POST['email'];
            $password = $_POST['password'];

            echo  "Email y Password entrados: ".$email." ".$password;
            $query = "SELECT * FROM usuarios";
            $r = mysqli_query($dbc, $query);
            if ($row = mysqli_fetch_array($r))
            {
                if ( (strtolower($_POST['email']) == $row['email']) && ($_POST['password'] ==$row['password'] ) )
                { // El usuario existe en la tabla... escoger otro email o password
                    echo "<p style='color:red;'>Email y/o Password escogidos ( ".$_POST['email']." , ".$_POST['password']." ) ya existen, por favor escoger otro o haga login.</p>";

                    echo "<a href='index.php'> Login </a>";
                    echo "<a href='register.php'> Volver a Intentar </a>";
                } 
                else //Email y Password no estan en la BD. Hacer query de insert.
                {
                    $nombre= $_POST['nombre'];
                    $apellido_p= $_POST['apellido_p'];
                    $apellido_m= $_POST['apellido_m'];

                    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_SPECIAL_CHARS);
                    $apellido_p = filter_input(INPUT_POST, 'apellido_p', FILTER_SANITIZE_SPECIAL_CHARS);
                    $apellido_m = filter_input(INPUT_POST, 'apellido_m', FILTER_SANITIZE_SPECIAL_CHARS);


                    //Query para insertar usuario.
                    $query = "INSERT INTO usuarios
                                ( email, password, nombre, apellido1, apellido2, rol)
                                VALUES ('".$email."', '".$password."', '".$nombre."', '".$apellido_p."', ".$apellido_m.", user)";
                    echo "<p>$query</p>";
                    $r = mysqli_query($dbc,$query);


                    if(mysqli_affected_rows($dbc) == 1)
                       print '<h3>El usuario ha sido insertado con éxito.</h3>';
                    else
                       print '<p style="color:red;">No se pudo insertar al estudiante porque:<br />' . mysqli_error($dbc) . '</p>';   
                    mysqli_close($dbc);

                    header('Location: user/index.php');
                }
            }
            else 
            { // Usuario no existe en la tabla

                print '<p>El email y/o password entrados no concuerdan con nuestros archivos!<br />Vuelva a intentarlo.<a href="index.php"> Login </a></p>';

            }
        }
        else
            print'<p> No se pudo conectar a servidor MYSQL</p>';

    }
    else
    {
        // No entró uno de los campos

        print '<p>Asegúrese de entrar su username y password. Vuelva a intentarlo...<br /><a href="index.php"> Login </a></p>';



    }
} 
else // No llegó por un submit, por lo tanto hay que presentar el formulario
{  
			
print '<div id="container"><center>
<h2> Registración </h2>
<p><span class="error">* campo requerido</span></p>
<form id="form1" name="form1" method="POST" action="register.php">
  <table id="table2" width="349" border="0">
    <tr>
      <td width="135" align="right">Nombre: </td>
      <td width="204" align="left">
      <input name="nombre" type="text" id="nombre" required/>
       <span class="error">*</span>
      </td>
    </tr>
    <tr>
      <td align="right">Apellido Paterno: </td>
      <td align="left">
      <input name="apellido_p" type="text" id="apellido_p" required/>
      <span class="error">*</span>
      </td>
    </tr>
    <tr>
      <td align="right">Apellido Materno: </td>
      <td align="left"><input name="apellido_m" type="text" id="apellido_m" /></td>
    </tr>
    <tr>
      <td align="right">E-mail: </td>
      <td align="left"><label for="email"></label>
      <input type="email" name="email" id="email" required/>
      <span class="error">*</span>
      </td>
    </tr>
    <tr>
      <td align="right">Password: </td>
      <td align="left"><label for="password"></label>
      <input type="password" name="password" id="password" required/>
      <span class="error">*</span>
      </td>
    </tr>
    
    <tr>
      <td colspan="2" align="center"><input type="submit" name="submit" id="submit" value="Registrar"/></td>
      </tr>
  </table>
</form>
</center></div>';
			  
}
			
			
?>
			

</body>
</html>