


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="estilo.css ">
</head>

<body>

    <form action="registar.php" method="post" onsubmit="return validateCedula(this.cedula.value)">


        <h1> Datos</h1>

        <div>
            <h3>nombre</h3>
            <input name="nombre" type="text" placeholder="nombre" required="" pattern="[a-zA-ZÀ-ÿ ]+[a-zA-ZÀ-ÿ]">
        </div>
        <div>
            <h3>apellido</h3>
            <input name="apellido" type="text" placeholder="apellido" required="" pattern="[a-zA-ZÀ-ÿ ]+[a-zA-ZÀ-ÿ]">
        </div>
        <div>
            <h3> cedula</h3>
            <input id="cedula" name="cedula" type="dni" placeholder="cedula" required onblur="validateCedula(this.value)">

            <p id="mensaje"></p>


        </div>
        <div>

            <h3> Fecha de nacimiento</h3>

            <input id="edad" name="fecha" type="date" placeholder="fecha de nacimiento" required>

            <p id="mensajes"></p>


        </div>

        <div>
            <h3>Correo</h3>
            <input name="correo" type="email" placeholder="correo" required="">

        </div>
        <div>

            <h3> Genero</h3>

            <select name="genero" required>
                <option value="" disabled selected>Selecciona una opción</option>
                <option value="masculino"> masculino</option>
                <option value="femenino">femenino</option>
            </select>

           



            

        </div>
        <div>
            <h3>Contraseña</h3>
            <input class="contraseña" name="contraseña" id="clave" type="password" placeholder="contraseña" required>


        </div>

   

        <button type="submit" value="Calcular Edad"> enviar</button>

    </form>


    <?php
    include 'eliminar.php';
    ?>


    <div class="dir">
        <h1>CRUD</h1>


        <table>
            <tr>
                <th>id</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>cedula</th>
                <th>fecha</th>
                <th>edad</th>
                <th>correo</th>
                <th>genero</th>
                <th>contraseña</th>
                <th>Borrar</th>
                <th>Actualizar</th>
            </tr>
            <?php
            $get_all = $dbh->prepare("SELECT * FROM datos");
            $get_all->execute();
            while ($fila = $get_all->fetch(PDO::FETCH_OBJ)) {
                echo "<tr><td>$fila->id</td><td>$fila->nombre</td><td>$fila->apellido</td><td>$fila->cedula</td><td>$fila->fecha</td><td>$fila->edad</td><td>$fila->correo</td><td>$fila->genero</td><td>$fila->contraseña</td><td><button onclick='borra($fila->id);'>❌</button></td><td><button id='boton' onclick='prueba($fila->id);'>Actualizar</button></td></tr>";
            }
            ?>
        </table>
        <script type="text/javascript">
            function borra(id) {
                window.location.replace("index.php?id=" + id);
            }
        </script>
        <script type="text/javascript">
            function prueba(id) {

                window.location.replace("editar.php?id=" + id);
            }
        </script>


    </div>




























</body>

<script>
    document.getElementById("edad").addEventListener("change", function() {
        var fecha = new Date(this.value);
        var hoy = new Date();
        var edad = hoy.getFullYear() - fecha.getFullYear();
        var m = hoy.getMonth() - fecha.getMonth();
        if (m < 0 || (m === 0 && hoy.getDate() < fecha.getDate())) {
            edad--;
        }
        document.getElementById("mensajes").innerHTML = "Su edad es: " + edad + " años.";
    });
</script>

<script src="cedula.js" type="text/javascript"></script>




</html>