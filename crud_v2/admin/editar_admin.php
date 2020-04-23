<!DOCTYPE html>
<?php
    //Conexion a base de datos.
    include('../conectiondb.php');
//    include('../localhostdb.php');

//Empezar Sesion.
session_start();
?>
<html>
<head>
    <meta charset="utf-8" />
    <title>Editar Info Admin</title>
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
    
if(isset($_GET['admin_id']) && is_numeric($_GET['admin_id']))
{
   $query = "SELECT *
			FROM admins
			WHERE admin_id={$_GET['admin_id']}";
    
   
   if ($r = mysqli_query($dbc, $query))
   {
	  $row = mysqli_fetch_array($r);
	  		
      print '<div><center><h2>Editar Cuenta Admin</h2>
      <form action="editar_admin.php" method="post">
      <table id="table2" width="349" border="0">
        
        <tr>
          <td align="right"><label for="nombre">Nombre: </label></td>
          <td align="left">
          <input type="text" name="nombre" id="nombre" value="' .$row['nombre'].'" required />
           <span class="error">*</span>
          </td>
        </tr>
        
        <tr>
          <td align="right"><label for="apellido_p">Apellido Paterno: </label></td>
          <td align="left">
          <input type="text" name="apellido_p" id="apellido_p" value="' .$row['apellido1'].'" required/> 
          <span class="error">*</span>
          </td>
        </tr>
        
        <tr>
          <td align="right"><label for="apellido_m">Apellido Materno: </label></td>
          <td align="left">
          <input type="text" name="apellido_m" id="apellido_m" value="' .$row['apellido2'].'" /></td>
        </tr>
        
        <tr>
          <td align="right"><label for="email">Email: </label></td>
          <td align="left"><label for="email"></label>
          <input type="email" name="email" id="email" value="'.$row['email'].'" required/>
          <span class="error">*</span>
          </td>
        </tr>
        
        <tr>
          <td align="right"><label for="password">Password: </label></td>
          <td align="left">
          <input type="password" name="password" id="password"  value="'.$row['pass'].'" required/> 
          <span class="error">*</span>
          </td>
        </tr>
        
        <tr>
          <td align="right"><label for="telefono">Teléfono: </label></td>
          <td align="left">
          <input type="tel" name="telefono" id="telefono" value="'.$row['telefono'].'"/> 
          <span class="error">*</span>
          </td>
        </tr>

        <tr>
        <td colspan="2" align="center">
          <input type="submit" name="Editar" id="Editar" value="Editar" />
		  <input type="hidden" name="admin_id" value="'.$_GET['admin_id'].'" />
        </td>
        </tr>
    </table>
    </form>
    </center>
   </div>';
   }
   else
      print '<h3 style="color:red;">No se puede mostrar la información del admin ya que ocurrió el error:<br />' . mysqli_error($dbc) . '</h3>';
	         
}
else if(isset($_POST['admin_id']) && is_numeric($_POST['admin_id']))
{
    $nombre = $_POST['nombre'];
    $apellido_paterno = $_POST['apellido_p'];
    $apellido_materno = $_POST['apellido_m'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $telefono = $_POST['telefono'];   

    $query2 = "UPDATE admins 
            SET nombre='$nombre', apellido1='$apellido_paterno', apellido2='$apellido_materno', email='$email', pass='$password', telefono='$telefono'
            WHERE admin_id={$_POST['admin_id']}";

    if(mysqli_query($dbc, $query2))
        print '<h3>La información del admin ha sido actualizada exitosamente!</h3>';
    else	  
        print '<h3 style="color:red;">No se pudo actualizar la información del admin ya que ocurrió el error:<br />' . mysqli_error($dbc). '</h3>';
}
else
{
   print '<h3 style="color:red;">Esta página ha sido accedida por error!</h3>';
}

mysqli_close($dbc);
?>
<button><a href="index.php" id='botton'> Ver Estudiantes </a></button>
</div>
</body>
</html>