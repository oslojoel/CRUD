<?php
// configuracion para acceder a la BD 
function conn (){
$hostname = "localhost";
$usuariodb = "root";
$passworddb = "";
$dbname = "toaquiza";
// Cadena de conexion con el servidor
$conectar = mysqli_connect($hostname,$usuariodb,$passworddb,$dbname);
return $conectar;




}
?>

<?php
try {
  ## Creamos la variable $dbh que es la conexión completa a la base de datos, pasándole
  # los parámetros de conexión del host, la base de datos, el usuario y la contraseña
    $dbh = new PDO("mysql:host=localhost;dbname=toaquiza", "root", "");
} catch (PDOException $e){
    $dbh = $e->getMessage();
}
?>