<?php
$host = "localhost";       // Dirección del servidor (localhost)
$usuario = "root";         // Usuario predeterminado de MySQL
$password = "";            // Contraseña (vacía por defecto en XAMPP/WAMP)
$base_datos = "tienda_ropa"; // Nombre de tu base de datos

$conn = new mysqli($host, $usuario, $password, $base_datos);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error); // Muestra un error si no se conecta
}
echo "Conexión exitosa a la base de datos.";
?>
