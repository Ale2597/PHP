<!-- Algoritmo para editar récord estudiantil
abrir php
conectarse a Base de datos localmente
if (se presionó editar estudiante en index.php )    //id llega por url, por lo tanto es un GET
{
    crear query para seleccionar estudiante con el id recibido en el url
    ejecutar query
    if ( se pudo ejecutar el query )
        mostrar formulario con método POST con los campos editables de ese estudiante
    else
        enviar mensaje de error
    cerrar conección
}
else if ( se presionó botón de editar del formulario mostrado )
{
    guardar en variables todos los datos del formulario 
    crear query para actualizar la información del estudiante 
    ejecutar query
    if ( se pudo ejecutar el query  )
        enviar mensaje de que se actualizó
    else
        enviar mensaje de error
}
else
    enviar mensaje de que no se llegó a esta página desde el index o por someter el formulario de editar
cerrar php

-->

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
    <title>Editar Info Usuario</title>
    <link href="https://fonts.googleapis.com/css?family=Source+Code+Pro&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../index.css">
</head>

<body>
<div id="container">
<?php
    
print '<div id="window">
            <div id="profile">
                <h3> Bienvenido usuario  '. $_SESSION['nombre_user'].'! </h3>
            </div>
       </div>';
    
if(isset($_GET['user_id']) && is_numeric($_GET['user_id']))
{
   $query = "SELECT email, pass, telefono
			FROM usuarios2
			WHERE user_id={$_GET['user_id']}";
    
   
   if ($r = mysqli_query($dbc, $query))
   {
	  $row = mysqli_fetch_array($r);
	  		
      print '<div><center><h2>Editar Cuenta Usuario</h2>
      <form action="editar_usuario.php" method="post">
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
      print '<h3 style="color:red;">No se puede mostrar la información del usuario ya que ocurrió el error:<br />' . mysqli_error($dbc) . '</h3>';
	         
}
else if(isset($_POST['user_id']) && is_numeric($_POST['user_id']))
{
	  $password = $_POST['password'];
	  $telefono = $_POST['telefono'];   

      $query = "UPDATE usuarios2 SET pass=$password, telefono=$telefono
		        WHERE user_id={$_POST['user_id']}";

	  if(mysqli_query($dbc, $query))
	        print '<h3>La información del usuario ha sido actualizada exitosamente!</h3>';
	  else	  
	        print '<h3 style="color:red;">No se pudo actualizar la información del usuario ya que ocurrió el error:<br />' . mysqli_error($dbc). '</h3>';
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