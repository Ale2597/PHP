<!-- Algoritmo para insertar récord
abrir php
if (se sometió el formulario)
{
    conectarse a Base de datos localmente
    guardar en variables todos los datos del nuevo estudiante de honor recibidos desde el formulario
    crear query para insertar estudiante nuevo
    ejecutar query
    if ( una fila fue afectada )
        enviar mensaje de que se insertó
    else
        enviar mensaje de error
    cerrar conección
}
cerrar php
presentar formulario

-->
<!DOCTYPE html>


<?php
    //Conexion a base de datos.
    include('../conectiondb.php');
//    include('../localhostdb.php');
?>
<html>
<head>
    <meta charset="UTF-8" />
    <title>Insertar Estudiante de Honor</title> 
    <link href="https://fonts.googleapis.com/css?family=Source+Code+Pro&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../index.css">
</head>
<body>
<div id="container">
<h1>Estudiantes de Honor</h1>

<?php
if (isset($_POST['submit']))
{
	
	$nombre= $_POST['nombre'];
	$apellido_p= $_POST['apellido_p'];
	$apellido_m= $_POST['apellido_m'];
	$email=$_POST['email'];
	$promedio= $_POST['promedio'];
	$depto_id= $_POST['depto_id'];
    
    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_SPECIAL_CHARS);
    $apellido_p = filter_input(INPUT_POST, 'apellido_p', FILTER_SANITIZE_SPECIAL_CHARS);
    $apellido_m = filter_input(INPUT_POST, 'apellido_m', FILTER_SANITIZE_SPECIAL_CHARS);

    
    //Query para insertar estudiante.
	$query = "INSERT INTO estudiante
				( apellido_p, apellido_m, nombre, email, promedio, depto_id)
				VALUES ('".$apellido_p."', '".$apellido_m."', '".$nombre."', '".$email."', ".$promedio.", ".$depto_id.")";
    echo "<p>$query</p>";
	$r = mysqli_query($dbc,$query);
	
	
	if(mysqli_affected_rows($dbc) == 1)
	   print '<h3>El estudiante ha sido insertado con éxito.</h3>';
	else
	   print '<p style="color:red;">No se pudo insertar al estudiante porque:<br />' . mysqli_error($dbc) . '</p>';   
	mysqli_close($dbc);
}
?>

<center>
<h2>Insertar Estudiante de Honor</h2>
<p><span class="error">* campo requerido</span></p>
<form id='form1' name='form1' method='POST' action='insertar_estudiantes_de_honor.php'>
  <table id='table2'width='349' border='0'>
    <tr>
      <td width="135" align='right'>Nombre</td>
      <td width="204" align='left'>
      <input name='nombre' type='text' id='nombre' required/>
       <span class="error">*</span>
      </td>
    </tr>
    <tr>
      <td align='right'>Apellido Paterno</td>
      <td align='left'>
      <input name='apellido_p' type='text' id='apellido_p' required/>
      <span class="error">*</span>
      </td>
    </tr>
    <tr>
      <td align='right'>Apellido Materno</td>
      <td align='left'><input name='apellido_m' type='text' id='apellido_m' /></td>
    </tr>
    <tr>
      <td align='right'>E-mail</td>
      <td align='left'><label for="email"></label>
      <input type="email" name="email" id="email" required/>
      <span class="error">*</span>
      </td>
    </tr>
    <tr>
      <td align='right'>Promedio</td>
      <td align='left'>
      <input type="number" size="6" name="promedio" min="3.50" max="4.00" step="0.01" required/>
      <span class="error">*</span>
      </td>
    </tr>
    <tr>
      <td align='right'>Departamento</td>
      <td align='left'>
      <select name='depto_id' id='lista' required>
      <?php
          
        //Query para seleccionar departamentos.
        $query2 = "SELECT * FROM departamento";

        $r2 = mysqli_query($dbc,$query2);
          
        echo "<p>$query2</p>";
    
        if($r2 = mysqli_query($dbc, $query2)){
            while($row2=mysqli_fetch_array($r2)){
                print '<option value='.$row2[depto_id].'>'.$row2[nombre].'</option>';
            }
        }
          
        ?>
      
  </select>
   <span class="error">*</span>
   </td>
    </tr>
    <tr>
      <td colspan='2' align='center'><input type='submit' name='submit' id='submit' value='Insertar'/></td>
      </tr>
  </table>
</form>
<br>
<button><a href='index.php' id='botton'> Ver Estudiantes </a></button>
<br>
</center>
</div>
</body>
</html>