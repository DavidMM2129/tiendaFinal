<?php
include_once 'conexion.php';

header("Content-Type: application/json");

try {
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
            HAVING 
                total_ventas > 0";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($result);
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
?>
