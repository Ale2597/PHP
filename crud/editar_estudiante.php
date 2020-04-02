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
    include('conectiondb.php');
?>
<html>
<head>
    <meta charset="utf-8" />
    <title>Editar Estudiante de Honor</title>
    <link href="https://fonts.googleapis.com/css?family=Source+Code+Pro&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="index.css">
</head>

<body>
<?php
    
if(isset($_GET['est_id']) && is_numeric($_GET['est_id']))
{
   $query = "SELECT e.est_id, e.nombre, e.apellido_p, e.apellido_m, e.email, e.depto_id, e.promedio
			FROM estudiante e
			WHERE est_id={$_GET['est_id']}";
    
   
   if ($r = mysqli_query($dbc, $query))
   {
	  $row = mysqli_fetch_array($r);
	  		
      print '<div><center><h2>Editar estudiante de honor</h2>
      <form action="editar_estudiante.php" method="post">
      <table id="table2"width="349" border="0">
      
        <tr>
          <td width="135" align="right"><label for="nombre">Nombre: </label></td>
          <td width="204" align="left">
          <input type="text" name="nombre" id="nombre" value="' .$row['nombre'].'" required />
           <span class="error">*</span>
          </td>
        </tr>
        
        <tr>
          <td align="right"><label for="apellido_p">Apellido Paterno: </label></td>
          <td align="left">
          <input type="text" name="apellido_p" id="apellido_p" value="' .$row['apellido_p'].'" required/> 
          <span class="error">*</span>
          </td>
        </tr>
        
        <tr>
          <td align="right"><label for="apellido_m">Apellido Materno: </label></td>
          <td align="left">
          <input type="text" name="apellido_m" id="apellido_m" value="' .$row['apellido_m'].'" /></td>
        </tr>
        
        <tr>
          <td align="right"><label for="email">Email: </label></td>
          <td align="left"><label for="email"></label>
          <input type="email" name="email" id="email" value="' .$row['email'].'" required/>
          <span class="error">*</span>
          </td>
        </tr>
        
        <tr>
          <td align="right"><label for="promedio">Promedio: </label></td>
          <td align="left">
          <input type="number" size="6" name="promedio" id="promedio"  value="'. $row['promedio'].'"  min="3.50" max="4.00" step="0.01" required/>         
          <span class="error">*</span>
          </td>
        </tr>
        
        <tr>
          <td align="right">Departamento</td>
          <td align="left">
          <select name="depto_id" id="lista" required>
          '; ?>
         
       <?php
          
        //Query para seleccionar departamentos.
        $query2 = "SELECT d.depto_id, d.nombre
                    FROM departamento d";

        $r2 = mysqli_query($dbc,$query2);
    
        if($r2 = mysqli_query($dbc, $query2))
        {
            while($row2=mysqli_fetch_array($r2))
            {
                print "<option value='$row2[depto_id]'";
                if ($row['depto_id']==$row2['depto_id']) echo "selected";
                
                print ">$row2[nombre]</option>";
            }
        }
       ?>
       <?php
       print '
      </select>
       <span class="error">*</span>
       </td>
        </tr>

        <tr>
        <td colspan="2" align="center">
          <input type="submit" name="Editar" id="Editar" value="Editar" />
		  <input type="hidden" name="est_id" value="'.$_GET['est_id'].'" />
        </td>
        </tr>
    </table>
    </form>
    </center>
   </div>';
   }
   else
      print '<p style="color:red;">No se puede mostrar la información del estudiante ya que ocurrió el error:<br />' . mysqli_error($dbc) . '</p>';
	         
}
else if(isset($_POST['est_id']) && is_numeric($_POST['est_id']))
{
	  $apellido_paterno = $_POST['apellido_p'];
	  $apellido_materno = $_POST['apellido_m'];
	  $nombre = $_POST['nombre'];
	  $email = $_POST['email'];
	  $departamento = $_POST['depto_id'];
	  $prom = $_POST['promedio'];   

      $query = "UPDATE estudiante SET apellido_p='$apellido_paterno', apellido_m ='$apellido_materno', 
		        nombre='$nombre', email='$email', promedio=$prom, depto_id=$departamento
		        WHERE est_id={$_POST['est_id']}";

	  if(mysqli_query($dbc, $query))
	        print '<p>La información del estudiante ha sido actualizada exitosamente</p>';
	  else	  
	        print '<p style="color:red;">No se pudo actualizar la información del estudiante ya que ocurrió el error:<br />' . mysqli_error($dbc);
}
else
   print '<p style="color:red;">Esta página ha sido accedida por error</p>';	  	

mysqli_close($dbc);
?>
<a href="index.php"> Ver estudiantes </a>
</body>
</html>