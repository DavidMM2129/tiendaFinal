<?php
include('conexion.php');
?>


<?php
// Consulta para obtener las prendas
$sql = "SELECT prendas.id_prenda, prendas.nombre AS prenda_nombre, 
               marcas.nombre AS marca_nombre, prendas.precio, prendas.cantidad_stock, prendas.talla
        FROM prendas
        JOIN marcas ON prendas.id_marca = marcas.id_marca";

$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Prenda</th><th>Marca</th><th>Precio</th><th>Stock</th><th>Talla</th></tr>";

    while ($fila = $resultado->fetch_assoc()) {
        echo "<tr>
                <td>{$fila['id_prenda']}</td>
                <td>{$fila['prenda_nombre']}</td>
                <td>{$fila['marca_nombre']}</td>
                <td>{$fila['precio']}</td>
                <td>{$fila['cantidad_stock']}</td>
                <td>{$fila['talla']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No hay datos disponibles.";
}

$conn->close();
?>
