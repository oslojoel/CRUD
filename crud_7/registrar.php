<?php

include_once('conectar.php');

$conectar = conn();
$cedula = $_POST['cedula'];
$fecha = new DateTime($_POST['fecha']);
$hoy = new DateTime();
$edad = $hoy->diff($fecha);
$edad = $edad->y;
$nombres =$_POST ['nombres'];
$direccion=$_POST ['direccion'];
$telefono=$_POST ['telefono'];
$genero=$_POST ['genero'];






// verificar datos existences en la base de datos

$sqla = "SELECT * FROM datos WHERE cedula   = '$cedula' ";
$resulta = mysqli_query($conectar, $sqla);

if (mysqli_num_rows($resulta) > 0) {
    echo "Este dato ya se encuentra registrado";
} else {
    // Submit the form or save the new data to the database
    $sql = "INSERT INTO datos (nombres,cedula, fecha, edad,direccion,telefono,genero) 
          VALUES ('$nombres','$cedula', ' " . $fecha->format('Y-m-d') . "', '$edad','$direccion','$telefono','$genero')";
    $result = mysqli_query($conectar, $sql) or trigger_error("Query failed! SQL- Error:" . mysqli_error($conectar), E_USER_ERROR);
    if ($result) {
        echo "Dato añadido correctamente";
    } else {
        echo "Error al añadir tu dato" . mysqli_error($conectar);
    }
}

?>
<div>
    <button type="button" onclick="location.href='toaquiza.php'">atrás</button>
</div>