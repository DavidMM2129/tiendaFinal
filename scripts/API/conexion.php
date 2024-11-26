<?php
// Configuración de la base de datos
$host = "localhost";
$usuario = "root";
$password = "";
$base_datos = "tienda_ropa";

// Crear conexión
$conn = new mysqli($host, $usuario, $password, $base_datos);

// Verificar conexión
if ($conn->connect_error) {
    die(json_encode(["error" => "Error de conexión: " . $conn->connect_error]));
}
?>


<?php
$host = 'localhost';
$db = 'tienda_ropa'; // Nombre correcto de la base de datos
$user = 'root';      // Usuario de la base de datos
$pass = '';          // Contraseña del usuario (deja vacío si usas XAMPP)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
