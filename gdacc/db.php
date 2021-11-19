<?php
$servername = 'localhost';
$username = 'guardia';
$password = 'Emilio01';
$database_name = 'guardia_v2';
$conexion = mysqli_connect($servername, $username, $password);
$db = mysqli_select_db($conexion,$database_name);
if (!$conexion){
    die("Error de conexion:".mysqli_connect_error());
}
?>
