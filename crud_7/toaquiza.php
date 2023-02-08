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

    <form action="registrar.php" method="post" onsubmit="return validateCedula(this.cedula.value) &&   validatePhoneNumber(this.telefono.value)">


        <h1> Datos</h1>

        <div>
            <h3>nombres</h3>
            <input name="nombres" type="text" placeholder="nombres" required="" pattern="[a-zA-ZÀ-ÿ ]+[a-zA-ZÀ-ÿ]">
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
            <h3>direccion</h3>
            <input name="direccion" type="text" placeholder="direccion" required="">

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
            <h3>telefono</h3>
            <input name="telefono" type="tel" placeholder="teléfono" required="" pattern="[0][9][0-9]{8}" title="Ingrese un número de teléfono válido">

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
                <th>Nombres</th>
                <th>cedula</th>
                <th>fecha</th>
                <th>edad</th>
                <th>direccion</th>
                <th>telefono</th>
                <th>genero</th>
                <th>Borrar</th>
                <th>Actualizar</th>
            </tr>
            <?php
            $get_all = $dbh->prepare("SELECT * FROM datos");
            $get_all->execute();
            while ($fila = $get_all->fetch(PDO::FETCH_OBJ)) {
                echo "<tr><td>$fila->id</td><td>$fila->nombres</td><td>$fila->cedula</td><td>$fila->fecha</td><td>$fila->edad</td><td>$fila->direccion</td><td>$fila->telefono</td><td>$fila->genero</td><td><button onclick='borra($fila->id);'>❌</button></td><td><button id='boton' onclick='prueba($fila->id);'>Actualizar</button></td></tr>";
            }
            ?>
        </table>
        <script type="text/javascript">
            function borra(id) {
                window.location.replace("toaquiza.php?id=" + id);
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