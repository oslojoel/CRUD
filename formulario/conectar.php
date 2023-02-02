<?php
// configuracion para acceder a la BD 
function conn (){
$hostname = "localhost";
$usuariodb = "root";
$passworddb = "";
$dbname = "prueba";
// Cadena de conexion con el servidor
$conectar = mysqli_connect($hostname,$usuariodb,$passworddb,$dbname);
return $conectar;




}
?>