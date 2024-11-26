<?php
include_once 'conexion.php';

header("Content-Type: application/json");

try {
    $sql = "SELECT 
                p.id_prenda,
                p.nombre AS prenda,
                p.cantidad_stock,
                SUM(tv.cantidad) AS cantidad_vendida
            FROM 
                prendas p
            JOIN 
                transacciones_ventas tv ON p.id_prenda = tv.id_prenda
            GROUP BY 
                p.id_prenda, p.nombre, p.cantidad_stock";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($result);
} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
?>
