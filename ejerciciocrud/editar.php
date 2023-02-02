<!DOCTYPE html>
<html>

<head>

</head>

<body>

    <body>
        <h1>Actualizar datos</h1>
        <?php
        include 'conectar.php';
        if (!empty($_POST['nombre']) && !empty($_POST['apellido']) && !empty($_POST['cedula']) && !empty($_POST['fecha']) && !empty($_POST['correo']) && !empty($_POST['genero']) && !empty($_POST['contraseña'])) {

            $cedula = $_POST['cedula'];
            $correo = $_POST['correo'];
            $id = $_GET['id'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $fecha = new DateTime($_POST['fecha']);
            $hoy = new DateTime();
            $edad = $hoy->diff($fecha);
            $edad = $edad->y;
            $genero = $_POST['genero'];
            $contraseña = $_POST['contraseña'];

            // Verificar si existe un registro con los mismos datos, menos el que se está editando
            $check_duplicate = $dbh->prepare("SELECT * FROM datos WHERE cedula = '$cedula' AND id != '$id' UNION 
                                              SELECT * FROM datos WHERE correo = '$correo' AND id != '$id'");
            $check_duplicate->execute();

            // Si no hay duplicados, se actualiza el registro
            if ($check_duplicate->rowCount() == 0) {
                $get_all = $dbh->prepare("UPDATE datos SET nombre = '$nombre', apellido = '$apellido', cedula = '$cedula', edad='$edad', fecha=' " . $fecha->format('Y-m-d') . "', correo = '$correo', genero = '$genero', contraseña = '$contraseña' WHERE id = '$id'");
                $get_all->execute();

                header('Location: index.php');
            } else {
                // Si existen duplicados, se muestra un mensaje de error
                echo "El registro que intenta actualizar ya existe en la base de datos";
            }
        } else if (!empty($_GET['id'])) {
            $id = $_GET['id'];
            echo "<form action='' method='POST'  onsubmit='return validateCedula(this.cedula.value)'   >";
            $get_all = $dbh->prepare("SELECT * FROM datos WHERE id = '$id'");
            $get_all->execute();
            while ($fila = $get_all->fetch(PDO::FETCH_OBJ)) {
                echo "Nombre a modificar: <input type='text' value='" . $fila->nombre . "' name='nombre'  required='' pattern='[a-zA-ZÀ-ÿ ]+[a-zA-ZÀ-ÿ]'>
            <br>Apellido a modificar: <input type='text' value='" . $fila->apellido . "' name='apellido'required='' pattern='[a-zA-ZÀ-ÿ ]+[a-zA-ZÀ-ÿ]'>
            <br>Cédula a modificar: <input type='dni' value='" . $fila->cedula . "' name='cedula'  id='cedula' required onblur='validateCedula(this.value)'>
            <p id='mensaje'></p>
            <br>Fecha a modificar: <input type='date' value='" . $fila->fecha . "' name='fecha' required=''>
            <br>Correo a modificar: <input type='email' value='" . $fila->correo . "' name='correo'required='' >
            <br>Género a modificar:
            <br> <select name='genero' required>
            <option value='' disabled>Selecciona una opción</option>
            <option value='masculino' " . ($fila->genero == 'masculino' ? 'selected' : '') . ">Masculino</option>
            <option value='femenino' " . ($fila->genero == 'femenino' ? 'selected' : '') . ">Femenino</option>
        </select>
            <br>contraseña a modificar: <input type='password' value='$fila->contraseña' name='contraseña'  required='' >";
            }
            echo "<br><input type='submit' value='Actualizar datos'></form>";
        } else {
            echo "<table>
		<tr>
			<th>ID</th>
			<th>Nombre</th>
			<th>Apellido</th>
            th>cedula</th>
            th>fecha</th>
            th>correo</th>
            th>genero</th>
            th>contraseña</th>
            
			<th>Actualizar</th>
		</tr>";

            $get_all = $dbh->prepare("SELECT * FROM datos");
            $get_all->execute();
            while ($fila = $get_all->fetch(PDO::FETCH_OBJ)) {
                echo "<tr><td>$fila->id</td><td>$fila->nombre</td><td>$fila->apellido</td><td>$fila->cedula</td><td>$fila->fecha</td><td>$fila->edad</td><td>$fila->correo</td><td>$fila->genero</td><td>$fila->contraseña</td><td><button id='boton' onclick='prueba($fila->id);'>Actualizar</button></td></tr>";
            }
            echo "</table>";
        }
        ?>
        <button type="button" onclick="location.href='index.php'">Cancelar</button>
        <script type="text/javascript">
            function prueba(id) {

                window.location.replace("editar.php?id=" + id);
            }
        </script>
        <script src="cedula.js" type="text/javascript"></script>

    </body>



</html>