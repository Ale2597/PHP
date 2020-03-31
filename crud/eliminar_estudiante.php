<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="utf-8">
        <title>Eliminar Estudiante</title>
        <link href="https://fonts.googleapis.com/css?family=Source+Code+Pro&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="index.css">
    </head>
    <body>
        <div id="container">
        <?php
            
        //Conexión a la base de datos por archivo externo.

        include_once('conectiondb.php');
       
            if(isset($_GET['est_id']) && is_numeric($_GET['est_id']))
            {
                
                $query = "SELECT e.est_id, e.nombre, e.apellido_p, e.apellido_m, e.email, d.nombre departamento, e.promedio
                FROM estudiante e, departamento d
                WHERE est_id = {$_GET['est_id']} AND e.depto_id = d.depto_id";
                
                if($r = mysqli_query($dbc, $query))
                {
                    
                    $row=mysqli_fetch_array($r);
                    
                    print '<form action="eliminar_estudiante.php" method="post">
                    
                    <h2>Esta Seguro que desea eliminar al siguiente estudiante de honor?</h2>
                
                    <table id="table1">
                        <tr id="table_header">
                            <td><b>Nombre</b></td>
                            <td><b>Apellido Paterno</b></td>
                            <td><b>Apellido Materno</b></td>
                            <td><b>E-mail</b></td>
                            <td><b>Departamento</b></td>
                            <td><b>Promedio</b></td>
                        </tr>

                        <tr id="table_rows">
                            <td>'.$row['nombre'].'</td>
                            <td>'.$row['apellido_p'].'</td>
                            <td>'.$row['apellido_m'].'</td>
                            <td>'.$row['email'].'</td>
                            <td>'.$row['departamento'].'</td>
                            <td>'.$row['promedio'].'</td>
                        </tr>
                            
                    </table>
                    <input type="hidden" name="est_id" value="'.$_GET['est_id'].'">
                    <p>
                    <input type="submit" name="submit" value="Eliminar Estudiante">
                    </p>';
                }            
                
                else
                {
                    print '<p style="color:red;">No se pudo mostrar al estudiante que se desea eliminar porque: 
                    <br/>'.mysqli_error($dbc).'.</p>';
                }
            }
            elseif(isset($_POST['est_id']) && is_numeric($_POST['est_id']))
            {
                $query = "DELETE FROM estudiante WHERE est_id={$_POST['est_id']} LIMIT 1";
                $r = mysqli_query($dbc, $query);
                
                if(mysqli_affected_rows($dbc) == 1)
                    print '<h3>El estudiante ha sido eliminado con exito.</h3>';
                else
                    print '<p style="color:red;">No se pudo eliminar al estudiante porque: 
                <br/>'.mysqli_error($dbc).'.</p>';
            }
            else
                print '<p style="color:red;">Esta pagina ha sido accedida con error!</p>';
            
            mysqli_close($dbc);
        
        ?>
        
        <button><a href='index.php' id='botton'> Ver Estudiantes </a></button>
        
        </div>
    </body>
</html>