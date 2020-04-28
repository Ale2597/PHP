<!DOCTYPE html>
<?php 
//Empezar Sesion.
session_start();

?>
<html>
<head>
    <meta charset="big5" />
    <title>LOGIN - Estudiantes de  Honor UPRA</title>
    <link href="https://fonts.googleapis.com/css?family=Source+Code+Pro&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="index.css">
</head>

<body>


    <h2>Programa de Honor </h2>
<!--    File de Login que ahora es el index para que el usuario tenga que hacer login antes de entrar a la pagina como tal.
include_once('conectiondb.php');
include_once('localhostdb.php');-->

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    if( (!empty($_POST['email'])) && (!empty($_POST['password'])) ) 
		{ //conectarme a ver si existe usuario    
			if(include_once('conectiondb.php')) // Conectarse al servidor SQL
	   		{
                $email = $_POST['email'];
                $password = $_POST['password'];

//                echo "<br><h3>Email: $email</h3>";
//                echo "<h3>Password: $password</h3><br>";
                $query = "SELECT * FROM usuarios2 WHERE email = '$email'  AND pass = '$password'";
                $r = mysqli_query($dbc, $query);
                
                $query2 = "SELECT * FROM admins WHERE email = '$email'  AND pass = '$password'";
                $r2 = mysqli_query($dbc, $query2);
                
                $query3 = "SELECT nombre FROM estudiante2 WHERE email = '$email'";
                $r3 = mysqli_query($dbc, $query3);
                $row3 = mysqli_fetch_array($r3);
                
                if ($row = mysqli_fetch_array($r))
                {
                    if ( (strtolower($_POST['email']) == $row['email']) && ($_POST['password'] ==$row['pass']) && ($row['status'] == 'activo') )
                    { // El usuario existe en la tabla de usuarios2.
      
                        $_SESSION['user_id'] = $row['user_id'];
                        $_SESSION['nombre_user'] = $row3['nombre'];
                        header('Location: user/index.php');
                        exit();
                    }
                    else{
                        print '<h3>Su cuenta aparenta estar inactiva! Por favor contacte un administrador para restaurar el acceso a su cuenta.<br><br><a href="index.php"> Login </a></h3>';
                    }
                }
                else if($row2 = mysqli_fetch_array($r2))
                {
                    if ( (strtolower($_POST['email']) == $row2['email']) && ($_POST['password'] ==$row2['pass']) && ($row2['status'] == 'activo') )
                    {//El usuario es admin.
                        
                        $_SESSION['nombre_admin'] = $row2['nombre'];
                        $_SESSION['admin_id'] = $row2['admin_id'];
                        header('Location: admin/index.php');
                        exit();
                    }
                }
                else 
                { // Usuario no existe en la tabla

                    print '<h3>El email y/o password entrados no concuerdan con nuestros archivos!<br><br>Vuelva a intentarlo.<a href="index.php"> Login </a></h3>';

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
    <form action="index.php" method="post">
    <table id="table3">
    <tr>
     <td colspan="2" align="center"><h3> LOGIN </h3></td
    </tr>
    <tr>
    <td align="right">Email: </td>
    <td align="left">
    <input type="email" name="email" size="20" required/>
    <span class="error">*</span>
    </td>
    </tr>
    <tr>
     <td align="right">Password: </td>
    <td align="left">
    <input type="password" name="password" size="20" required/>
    <span class="error">*</span>
    </td>
    </tr>
    <tr>
     <td colspan="2" align="center">
     <input type="submit" name="submit" value="Login" /></td>
    </tr>
    <tr>
     <td colspan="1" align="left">
     <a href="estudiantes.php"> No soy estudiante! </a></td>

     <td colspan="1" align="right">
     <a href="register.php"> Estudiante? Regístrate! </a></td>
    </tr>
    </table>
    </form></center></div>';
			  
}
			
			
?>
			

</body>
</html>