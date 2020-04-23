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
    <meta charset="utf-8" />
    <title>Editar Cuentas de Usuarios</title>
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
    
if(isset($_GET['user_id']) && is_numeric($_GET['user_id']))
{
   $query = "SELECT *
            FROM usuarios2
			WHERE user_id={$_GET['user_id']}";
    
   
   if ($r = mysqli_query($dbc, $query))
   {
	  $row = mysqli_fetch_array($r);
	  		
      print '<div><center><h2>Editar Cuenta Usuario</h2>
      <form action="editar_cuentas_usuarios.php" method="post">
      <table id="table2" width="349" border="0">
      
        <tr>
          <td align="right"><label for="email">Email: </label></td>
          <td align="left"><label for="email"></label>'.$row['email'].'"
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
          </td>
        </tr>
        
        <tr>
          <td align="right"><label for="status">Status: </label></td>
          <td align="left">
          <input type="text" name="status" id="status" value="'.$row['status'].'" required/> 
          <span class="error">*</span>
          </td>
        </tr>

        <tr>
        <td colspan="2" align="center">
          <input type="submit" name="Editar" id="Editar" value="Editar" />
		  <input type="hidden" name="user_id" value="'.$_GET['user_id'].'" />
        </td>
        </tr>
    </table>
    </form>
    </center>
   </div>';
   }
   else
      print '<h3 style="color:red;">No se puede mostrar la información del estudiante ya que ocurrió el error:<br />' . mysqli_error($dbc) . '</h3>';
	         
}
else if(isset($_POST['user_id']) && is_numeric($_POST['user_id']))
{
    $password = $_POST['password'];
    $telefono = $_POST['telefono']; 
    $status = $_POST['status'];

    $query = "UPDATE usuarios2 SET pass='$password', telefono='$telefono', status='$status'
            WHERE user_id={$_POST['user_id']}";

    if(mysqli_query($dbc, $query))
        print '<h3>La información del estudiante ha sido actualizada exitosamente</h3>';
    else	  
        print '<p style="color:red;">No se pudo actualizar la información del estudiante ya que ocurrió el error:<br />' . mysqli_error($dbc);
}
else
   print '<p style="color:red;">Esta página ha sido accedida por error</p>';	  	

mysqli_close($dbc);
?>
<button><a href='cuentas_usuarios.php' id='botton'> Ver Usuarios </a></button>
</div>
</body>
</html>