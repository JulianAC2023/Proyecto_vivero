<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Proyecto</title>
</head>
<body>
    <h1>Datos de la Base de Datos</h1>

    <?php
    // Incluir el archivo de conexión
    include 'index.php'; // Asegúrate de que 'index.php' contiene la conexión correcta

    // Realizar una consulta
    $consulta = "SELECT * FROM productos"; // Asegúrate de que 'productos' es el nombre correcto de la tabla
    $resultado = $conexion->query($consulta);

    if (!$resultado) {
        die("Error en la consulta: " . $conexion->error);
    }

    if ($resultado->num_rows > 0) {
        echo "<table border='1'><tr><th>ProductoID</th><th>Nombre</th><th>Descripcion</th><th>Valor</th><th>CantidadDisponible</th><th>FechaRegistro</th><th>CategoriaID</th><th>ProveedorID</th></tr>";
        while ($fila = $resultado->fetch_assoc()) {
            echo "<tr><td>" . htmlspecialchars($fila["ProductoID"]) . "</td><td>" . htmlspecialchars($fila["Nombre"]) . "</td><td>" . htmlspecialchars($fila["Descripcion"]) . "</td><td>" . htmlspecialchars($fila["Valor"]) . "</td><td>" . htmlspecialchars($fila["CantidadDisponible"]) . "</td><td>" . htmlspecialchars($fila["FechaRegistro"]) . "</td><td>" . htmlspecialchars($fila["CategoriaID"]) . "</td><td>" . htmlspecialchars($fila["ProveedorID"]) . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No se encontraron resultados.</p>";
    }

    // Cerrar la conexión
    $conexion->close();
    ?>
</body>
</html>
