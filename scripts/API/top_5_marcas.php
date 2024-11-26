<?php
// Incluye el archivo de conexión a la base de datos
include_once 'conexion.php';

// Configura la respuesta como JSON
header("Content-Type: application/json");

try {
    // Query para obtener las 5 marcas más vendidas
    $sql = "SELECT 
                m.id_marca,
                m.nombre AS marca,
                COUNT(tv.id_venta) AS total_ventas
            FROM 
                marcas m
            JOIN 
                prendas p ON m.id_marca = p.id_marca
            JOIN 
                transacciones_ventas tv ON p.id_prenda = tv.id_prenda
            GROUP BY 
                m.id_marca, m.nombre
            ORDER BY 
                total_ventas DESC
            LIMIT 5";

    // Prepara y ejecuta el query
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // Obtén los resultados
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Devuelve los resultados en formato JSON
    echo json_encode($result);

} catch (PDOException $e) {
    // Manejo de errores
    echo json_encode(["error" => $e->getMessage()]);
}
?>
