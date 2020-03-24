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
<html>
<head>
    <meta charset="UTF-8" />
    <title>Insertar Estudiante de Honor</title> 
</head>
<body>
<h1>Estudiantes de Honor</h1>

<?php
if (isset($_POST['submit']))
{
	$dbc = @mysqli_connect('localhost', 'root', '','programahonor') 
           OR die('No se pudo conectar a MySQL: '. mysqli_connect_error());
	
	
	$nombre= $_POST['nombre'];
	$apellido_p= $_POST['apellido_p'];
	$apellido_m= $_POST['apellido_m'];
	$email=$_POST['email'];
	$promedio= $_POST['promedio'];
	$depto_id= $_POST['depto_id'];

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

<h2>Insertar Estudiante de Honor</h2>
<form id='form1' name='form1' method='POST' action='insertar_estudiantes_de_honor.php'>
  <table width='349' border='0'>
    <tr>
      <td width="135" align='right'>Nombre</td>
      <td width="204" align='left'><input name='nombre' type='text' id='nombre' /></td>
    </tr>
    <tr>
      <td align='right'>Apellido Paterno</td>
      <td align='left'><input name='apellido_p' type='text' id='apellido_p' /></td>
    </tr>
    <tr>
      <td align='right'>Apellido Materno</td>
      <td align='left'><input name='apellido_m' type='text' id='apellido_m' /></td>
    </tr>
    <tr>
      <td align='right'>E-mail</td>
      <td align='left'><label for="email"></label>
      <input type="text" name="email" id="email" /></td>
    </tr>
    <tr>
      <td align='right'>Promedio</td>
      <td align='left'><input name='promedio' type='text' id='promedio' /></td>
    </tr>
    <tr>
      <td align='right'>Departamento</td>
      <td align='left'><select name='depto_id' id='lista'>
    <option value='1'>ESPA</option>
    <option value='2'>INGL</option>
    <option value='3'>MATE</option>
    <option value='4'>CISO</option>
    <option value='5'>HUMA</option>
    <option value='6'>TEQU</option>
    <option value='7'>CCOM</option>
    <option value='8'>BIOL</option>
    <option value='9'>COMU</option>
    <option value='10'>ADEM</option>
    <option value='11'>ENFE</option>
    <option value='12'>EDUC</option>
          <option value='13'>SOFI</option>
  </select></td>
    </tr>
    <tr>
      <td colspan='2' align='center'><input type='submit' name='submit' id='submit' value='Insertar'/></td>
      </tr>
  </table>
</form>

<a href="index.php"> Ver estudiantes </a>
</body></html>