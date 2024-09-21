<?php
session_start();
if (!isset($_SESSION['nombre_usuario'])) {
    header("Location: Login.html");
    exit();
}

include 'index.php'; // Asegúrate de que 'index.php' contiene la conexión correcta

$pedidoID = isset($_GET['PedidoID']) ? $_GET['PedidoID'] : '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener datos del formulario
    $estado = $_POST['estado'];
    $cantidad = $_POST['cantidad'];
    $total = $_POST['total'];

    // Actualizar la base de datos
    $updateQuery = "UPDATE pedidos SET Estado = ?, Cantidad = ?, Total = ? WHERE PedidoID = ?";
    $stmt = $conexion->prepare($updateQuery);
    $stmt->bind_param("sidi", $estado, $cantidad, $total, $pedidoID);

    if ($stmt->execute()) {
        echo "<div class='alert alert-success' role='alert'>Pedido actualizado exitosamente.</div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'>Error al actualizar el pedido: " . $stmt->error . "</div>";
    }
}

// Obtener los detalles del pedido
$selectQuery = "SELECT Estado, Cantidad, Total FROM pedidos WHERE PedidoID = ?";
$stmt = $conexion->prepare($selectQuery);
$stmt->bind_param("i", $pedidoID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $pedido = $result->fetch_assoc();
} else {
    echo "<div class='alert alert-danger' role='alert'>Pedido no encontrado.</div>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pedido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Inicio</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <!-- Otros enlaces de navegación -->
            </ul>
            <span class="navbar-text">
                Bienvenido, <?php echo htmlspecialchars($_SESSION['nombre_usuario']); ?>
            </span>
        </div>
    </nav>

    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Admin Panel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="Main_admin.php">Panel de Control</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Gestion de contenidos.php">Gestión de Contenidos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Gestion de usuarios.php">Gestión de Usuarios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Configuracion.php">Configuración</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Soporte.php">Soporte</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Formulario de edición -->
    <div class="container my-4">
        <h2>Editar Pedido</h2>
        <form method="POST">
        <div class="mb-3">
    <label for="estado" class="form-label">Estado</label>
    <select id="estado" name="estado" class="form-control" required>
        <option value="">Selecciona un estado</option>
        <option value="Pendiente" <?php echo ($pedido['Estado'] === 'Pendiente') ? 'selected' : ''; ?>>Pendiente</option>
        <option value="Enviado" <?php echo ($pedido['Estado'] === 'Enviado') ? 'selected' : ''; ?>>Enviado</option>
        <option value="Entregado" <?php echo ($pedido['Estado'] === 'Entregado') ? 'selected' : ''; ?>>Entregado</option>
        <option value="Cancelado" <?php echo ($pedido['Estado'] === 'Cancelado') ? 'selected' : ''; ?>>Cancelado</option>
    </select>
    </div>
            <div class="col-md-4 mb-3 d-flex align-items-end">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="number" id="cantidad" name="cantidad" class="form-control" value="<?php echo htmlspecialchars($pedido['Cantidad']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="total" class="form-label">Total</label>
                <input type="number" id="total" name="total" class="form-control" value="<?php echo htmlspecialchars($pedido['Total']); ?>" required>
            </div>
            <input type="hidden" name="pedidoID" value="<?php echo htmlspecialchars($pedidoID); ?>">
            <button type="submit" class="btn btn-primary">Actualizar Pedido</button>
        </form>
    </div>

        <!-- Cerrar sesión -->
    <div class="container mt-5">
        <a href="logout.php" class="btn btn-danger">Cerrar Sesión</a>
    </div>

<!-- Footer -->
<footer>
    <div class="container">
        <button class="btn btn-success" onclick="window.location.href='Desarrolladores.html';">Desarrolladores</button>
        <p>&copy; 2024 Vivero Plantas Nueva Vida. Todos los derechos reservados.</p>
    </div>
</footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
