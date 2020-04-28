<!DOCTYPE html>
<?php 
//Empezar Sesion.
session_start();

?>
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
        if(include_once('conectiondb.php')) // Conectarse al servidor SQL
        {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $con_pass = $_POST['con_pass'];

//            echo "<br><h3>Email: $email</h3>";
//            echo "<h3>Password: $password</h3><br>";
            
            $query = "SELECT * FROM usuarios2 WHERE email = '$email'  AND pass = '$password'";
            $r = mysqli_query($dbc, $query);
            
            if ($row = mysqli_fetch_array($r))
                {
                
                    if ( (strtolower($_POST['email']) == $row['email']))
                    { // El usuario existe en la tabla usuarios2... escoger otro email o password

                        echo "<h3 style='color:red;'>Email y/o Password escogidos ( ".$_POST['email']." , ".$_POST['password']." ) ya existen, por favor escoger otro o haga login.</h3>";

                        echo "<a href='index.php'> Login </a><br>";
                        echo "<a href='register.php'> Volver a Intentar </a>";

                    } 
                }
                else 
                { // Usuario NO existe en tabla usuarios2.

                    $query2 = "SELECT * FROM estudiante2 WHERE email = '$email'";
                        $r2 = mysqli_query($dbc, $query2);
            
                        if ($row2 = mysqli_fetch_array($r2))
                            {

                                if ( (strtolower($_POST['email']) == $row2['email']) && ($password == $con_pass))
                                {//Usuario es estudiante (Existe en la tabla estudiante2) 
                                    //Passwords entrados concuerdan.
                                    //Hacer query de insert.
                        

                                    $telefono = $_POST['telefono'];

                                    $telefono = filter_input(INPUT_POST, 'telefono', FILTER_SANITIZE_SPECIAL_CHARS);
                                    
                                    $status = 'activo';


                                    //Query para insertar usuario.
                                    $query3 = "INSERT INTO usuarios2
                                                (email, pass, telefono, status)
                                                VALUES ('".$email."', '".$password."', '".$telefono."', '".$status."')";

                                    echo "<h3>$query3</h3>";
                                    
                                    $r3 = mysqli_query($dbc,$query3);


                                    if(mysqli_affected_rows($dbc) == 1)
                                    {
                                       print '<h3>El usuario ha sido insertado con éxito.</h3>';
                                        
                                        $query4 = "SELECT * FROM usuarios2 WHERE email = '$email'                                                         AND pass = '$password'";
                                        $r4 = mysqli_query($dbc, $query4);
            
                                        if ($row4 = mysqli_fetch_array($r4))
                                        {
                                            $_SESSION['user_id'] = $row4['user_id'];
                                            $_SESSION['nombre_user'] = $row2['nombre'];
                                            header('Location: user/index.php');
                                        }
                                    }
                                    else
                                       print '<h3 style="color:red;">No se pudo insertar al usuario porque:<br />' . mysqli_error($dbc) . '</h3>';   
                                    mysqli_close($dbc);
                                    
                                }//Passwords no concuerda!!!
                                else
                                {
//                                    print '<h3>Passwords no concuerda!!!</h3>';
                                    $err_message = 'Passwords no concuerdan!';
                                    $_SESSION['err_mess'] = $err_message;
                                    $_SESSION['email'] = $email;
                                    $_SESSION['tel'] = $telefono;
                                    
                                    header('Location: register.php');
                                }
                            }
                            else//VISITANTE
                            {//Usuario no es estudiante (NO existe en tabla estudiante2)
                                print '<h3>Solo estudiantes pueden registrarse!</h3>';
                                print '<h3>Si es estudiante, asegúrese entrar su email correctamente. Vuelva a intentarlo...<br /><a href="register.php"> Registrar </a></h3>';
                                print '<h3>Para ver los estudiantes de honor como visitante oprima
                                <a href="estudiantes.php">Aquí</a></h3>';
                            }

                }
        }
        else
            print'<h3> No se pudo conectar a servidor MYSQL</h3>';

    }
    else
    {
        // No entró uno de los campos

        print '<h3>Asegúrese de entrar su email y password. Vuelva a intentarlo...<br /><a href="register.php"> Registrar </a></h3>';



    }
} 
else // No llegó por un submit, por lo tanto hay que presentar el formulario
{  
 
if(empty($_SESSION['email']))
{
    $_SESSION['email'] = "";
    $_SESSION['tel'] = ""; 
    $_SESSION['err_mess'] = "";
}
			
print '<div id="container"><center>
<h2> Registración </h2>
<p><span class="error">* campo requerido</span></p>
<form id="form1" name="form1" method="POST" action="register.php">
  <table id="table2" width="349" border="0">
  
    <tr>
      <td align="right">E-mail: </td>
      <td align="left"><label for="email"></label>
      <input type="email" name="email" id="email" value="'.$_SESSION['email'].'" required/>
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
    <span class="error">'.$_SESSION['err_mess'].'</span>
      <td align="right">Confirm Password: </td>
      <td align="left"><label for="con_pass"></label>
      <input type="password" name="con_pass" id="con_pass" required/>
      <span class="error">*</span>
      </td>
    </tr>
    
    <tr>
      <td align="right">Telefono: </td>
      <td align="left"><label for="telefono"></label>
      <input type="tel" name="telefono" id="telefono" value="'.$_SESSION['tel'].'"/>
      </td>
    </tr>
      
    <tr>
      <td colspan="2" align="center"><input type="submit" name="submit" id="submit" value="Registrar"/></td>
      </tr>
  </table>
</form>
<br>
<button><a href="index.php" id="botton"> Regresar </a></button>

</center></div>';
			  
}
			
//pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"		
?>
			

</body>
</html>