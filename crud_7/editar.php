<!DOCTYPE html>
<html>

<head>

</head>

<body>

    <body>
        <h1>Actualizar datos</h1>
        <?php
        include 'conectar.php';
        if (!empty($_POST['nombres'])  && !empty($_POST['cedula']) && !empty($_POST['fecha']) && !empty($_POST['direccion']) && !empty($_POST['telefono']) && !empty($_POST['genero'])) {

            $cedula = $_POST['cedula'];
            $direccion = $_POST['direccion'];
            $id = $_GET['id'];
            $nombres = $_POST['nombres'];
            $fecha = new DateTime($_POST['fecha']);
            $hoy = new DateTime();
            $edad = $hoy->diff($fecha);
            $edad = $edad->y;
            $genero = $_POST['genero'];
            $telefono = $_POST['telefono'];

            // Verificar si existe un registro con los mismos datos, menos el que se está editando
            $check_duplicate = $dbh->prepare("SELECT * FROM datos WHERE cedula = '$cedula' AND id != '$id'");
            $check_duplicate->execute();

            // Si no hay duplicados, se actualiza el registro
            if ($check_duplicate->rowCount() == 0) {
                $get_all = $dbh->prepare("UPDATE datos SET nombres = '$nombres', cedula = '$cedula', fecha=' " . $fecha->format('Y-m-d') . "', edad='$edad', direccion = '$direccion', telefono = '$telefono', genero = '$genero' WHERE id = '$id'");
                $get_all->execute();

                header('Location: toaquiza.php');
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
                echo "Nombres a modificar: <input type='text' value='" . $fila->nombres . "' name='nombres'  required='' pattern='[a-zA-ZÀ-ÿ ]+[a-zA-ZÀ-ÿ]'>
    
            <br>Cédula a modificar: <input type='dni' value='" . $fila->cedula . "' name='cedula'  id='cedula' required onblur='validateCedula(this.value)'>
            <p id='mensaje'></p>
            <br>Fecha a modificar: <input type='date' value='" . $fila->fecha . "' name='fecha' required=''>
            <br>direccion a modificar: <input type='text' value='" . $fila->direccion . "' name='direccion'required='' >
            <br>Género a modificar:
            <br> <select name='genero' required>
            <option value='' disabled>Selecciona una opción</option>
            <option value='masculino' " . ($fila->genero == 'masculino' ? 'selected' : '') . ">Masculino</option>
            <option value='femenino' " . ($fila->genero == 'femenino' ? 'selected' : '') . ">Femenino</option>
        </select>
            <br>telefono a modificar: <input type='telf' value='$fila->telefono' name='telefono' required='' pattern='[0][9][0-9]{8}' title='Ingrese un número de teléfono válido'>";
            }
            echo "<br><input type='submit' value='Actualizar datos'></form>";
        } else {
            echo "<table>
		<tr>
			<th>id</th>
			<th>Nombres</th>
		
            th>cedula</th>
            th>fecha</th>
            th>direccion</th>
            th>telefono</th>
            th>genero</th>
            
			<th>Actualizar</th>
		</tr>";

            $get_all = $dbh->prepare("SELECT * FROM datos");
            $get_all->execute();
            while ($fila = $get_all->fetch(PDO::FETCH_OBJ)) {
                echo "<tr><td>$fila->id</td><td>$fila->nombres</td><td>$fila->cedula</td><td>$fila->fecha</td><td>$fila->edad</td><td>$fila->direccion</td><td>$fila->telefono</td><td>$fila->genero</td><td><button id='boton' onclick='prueba($fila->id);'>Actualizar</button></td></tr>";
            }
            echo "</table>";
        }
        ?>
        <button type="button" onclick="location.href='toaquiza.php'">Cancelar</button>
        <script type="text/javascript">
            function prueba(id) {

                window.location.replace("editar.php?id=" + id);
            }
        </script>
        <script src="cedula.js" type="text/javascript"></script>

    </body>



</html>