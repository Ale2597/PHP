<!DOCTYPE html>
<html>
<head>
    <meta charset="big5" />
    <title>LOGIN - Estudiantes de  Honor UPRA</title>
</head>

<body>


    <h2>LOGIN - Programa de Honor </h2>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') 
{
		if( (!empty($_POST['username'])) && (!empty($_POST['password'])) ) 
		{ //conectarme a ver si existe usuario    
			if($dbc = @mysqli_connect('localhost', 'root', '','programahonor') OR die('No se pudo conectar a MySQL: '. mysqli_connect_error())) // Conectarse al servidor SQL
	   		{
					$username = $_POST['username'];
					$password = $_POST['password'];
		   
			  		echo  "User y password entrados: ".$username." ".$password;
			  		$query = "SELECT * FROM usuarios WHERE email = '$username'  AND password = '$password'";
			 		$r = mysqli_query($dbc, $query);
			 		if ($row = mysqli_fetch_array($r))
                    {
                        if ( (strtolower($_POST['username']) == $row['email']) && ($_POST['password'] ==$row['password'] ) )
                        { // El usuario existe en la tabla... escoger a dónde va por su categoría
                            echo "Info de la tabla usuarios";
                            echo $row['email'];
                            echo $row['password'];
                            echo $row['rol'];
                            if ($row['rol']== "admin")

                                  header('Location: admin/index.php');
                            else
                                  header('Location: user/index.php');
                            exit();


                        } 
                    }
					else 
					{ // Usuario no existe en la tabla
					
					  	print '<p>El username y/o password entrados no concuerdan con nuestros archivos!<br />Vuelva a intentarlo.<a href="login.php"> Login </a></p>';
					  
					}
			}
			else
				print'<p> No se pudo conectar a servidor MYSQL</p>';
		
        }
        else
        {
            // No entró uno de los campos

            print '<p>Asegúrese de entrar su username y password. Vuelva a intentarlo...<br /><a href="login.php"> Login </a></p>';



        }
} 
else // No llegó por un submit, por lo tanto hay que presentar el formulario
{  
			
			  print '<form action="login.php" method="post">
			  <p>Username: <input type="text" name="username" size="20" /></p>
			  <p>Password: <input type="password" name="password" size="20" /></p>
			  <p><input type="submit" name="submit" value="Entrar!" /></p>
			  </form>';
			  
}
			
			
?>
			

</body>
</html>