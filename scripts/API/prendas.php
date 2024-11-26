<?php
header("Content-Type: application/json");
include 'conexion.php';

// Obtener el método HTTP
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        // Obtener todas las prendas o una específica
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $sql = "SELECT prendas.id_prenda, prendas.nombre AS prenda_nombre, 
                           marcas.nombre AS marca_nombre, prendas.precio, prendas.cantidad_stock, prendas.talla
                    FROM prendas
                    JOIN marcas ON prendas.id_marca = marcas.id_marca
                    WHERE prendas.id_prenda = $id";
        } else {
            $sql = "SELECT prendas.id_prenda, prendas.nombre AS prenda_nombre, 
                           marcas.nombre AS marca_nombre, prendas.precio, prendas.cantidad_stock, prendas.talla
                    FROM prendas
                    JOIN marcas ON prendas.id_marca = marcas.id_marca";
        }

        $resultado = $conn->query($sql);
        $prendas = [];
        while ($fila = $resultado->fetch_assoc()) {
            $prendas[] = $fila;
        }

        echo json_encode($prendas);
        break;

    case 'POST':
        // Insertar una nueva prenda
        $data = json_decode(file_get_contents("php://input"), true);
        $nombre = $data['nombre'];
        $id_marca = $data['id_marca'];
        $precio = $data['precio'];
        $cantidad_stock = $data['cantidad_stock'];
        $talla = $data['talla'];

        $sql = "INSERT INTO prendas (nombre, id_marca, precio, cantidad_stock, talla) 
                VALUES ('$nombre', $id_marca, $precio, $cantidad_stock, '$talla')";
        if ($conn->query($sql)) {
            echo json_encode(["message" => "Prenda creada exitosamente."]);
        } else {
            echo json_encode(["error" => "Error al crear la prenda."]);
        }
        break;

    case 'PUT':
        // Actualizar una prenda existente
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $data = json_decode(file_get_contents("php://input"), true);
            $nombre = $data['nombre'];
            $id_marca = $data['id_marca'];
            $precio = $data['precio'];
            $cantidad_stock = $data['cantidad_stock'];
            $talla = $data['talla'];

            $sql = "UPDATE prendas 
                    SET nombre = '$nombre', id_marca = $id_marca, precio = $precio, 
                        cantidad_stock = $cantidad_stock, talla = '$talla'
                    WHERE id_prenda = $id";

            if ($conn->query($sql)) {
                echo json_encode(["message" => "Prenda actualizada exitosamente."]);
            } else {
                echo json_encode(["error" => "Error al actualizar la prenda."]);
            }
        }
        break;

    case 'DELETE':
        // Eliminar una prenda
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $sql = "DELETE FROM prendas WHERE id_prenda = $id";
            if ($conn->query($sql)) {
                echo json_encode(["message" => "Prenda eliminada exitosamente."]);
            } else {
                echo json_encode(["error" => "Error al eliminar la prenda."]);
            }
        }
        break;

    default:
        echo json_encode(["error" => "Método no soportado"]);
        break;
}

$conn->close();
?>
