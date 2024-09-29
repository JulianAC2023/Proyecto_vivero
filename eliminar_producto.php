<?php
session_start();
if (!isset($_SESSION['nombre_usuario'])) {
    header("Location: Login.html");
    exit();
}

include 'connection.php';

if (isset($_GET['ProductoID'])) {
    $productoID = intval($_GET['ProductoID']); // Asegúrate de que sea un entero.

    // Iniciar una transacción
    $conexion->begin_transaction();

    try {
        // Deshabilitar las restricciones de clave foránea
        if (!$conexion->query("SET FOREIGN_KEY_CHECKS = 0")) {
            throw new Exception("Error al deshabilitar las restricciones: " . $conexion->error);
        }

        // Eliminar los registros relacionados en viv_inventario
        if (!$conexion->query("DELETE FROM viv_inventario WHERE ProductoID = $productoID")) {
            throw new Exception("Error al eliminar de viv_inventario: " . $conexion->error);
        }

        // Eliminar el producto
        $consulta = "DELETE FROM viv_productos WHERE ProductoID = ?";
        $stmt = $conexion->prepare($consulta);

        if ($stmt) {
            $stmt->bind_param('i', $productoID);
            
            if (!$stmt->execute()) {
                throw new Exception("Error al eliminar el producto: " . $stmt->error);
            }

            $stmt->close();
        } else {
            throw new Exception("Error en la preparación de la consulta: " . $conexion->error);
        }

        // Habilitar las restricciones de clave foránea
        if (!$conexion->query("SET FOREIGN_KEY_CHECKS = 1")) {
            throw new Exception("Error al habilitar las restricciones: " . $conexion->error);
        }

        // Confirmar la transacción
        $conexion->commit();

        // Almacenar mensaje de éxito en la sesión
        $_SESSION['mensaje'] = "Producto eliminado exitosamente.";
        header("Location: Gestion de productos.php");
        exit();
    } catch (Exception $e) {
        // Si hay un error, revertir la transacción
        $conexion->rollback();

        // Almacenar mensaje de error en la sesión
        $_SESSION['error'] = "Error: " . $e->getMessage();
        header("Location: Gestion de productos.php");
        exit();
    }
} else {
    $_SESSION['error'] = "ProductoID no proporcionado.";
    header("Location: Gestion de productos.php");
    exit();
}

$conexion->close();
?>
