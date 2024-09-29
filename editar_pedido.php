<?php
session_start();
if (!isset($_SESSION['nombre_usuario'])) {
    header("Location: Login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina principal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="Styles.css">
    <style>
        .alert-container {
            position: absolute;
            top: 20%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 300px;
        }
    </style>

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
                    <a class="nav-link active" href="Main_admin.php">Gestion de Pedidos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Gestion de productos.php">Gestión de Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Gestion de usuarios.php">Gestión de Usuarios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Soporte.php">Soporte</a>
                </li>
            </ul>
        </div>
    </nav>
<?php    
include 'connection.php';

$pedidoID = isset($_GET['PedidoID']) ? $_GET['PedidoID'] : '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener datos del formulario
    $estado = $_POST['estado'];
    $cantidad = $_POST['cantidad'];
    $total = $_POST['total'];

    // Actualizar la base de datos
    $updateQuery = "UPDATE viv_pedidos SET Estado = ?, Cantidad = ?, Total = ? WHERE PedidoID = ?";
    $stmt = $conexion->prepare($updateQuery);
    $stmt->bind_param("sidi", $estado, $cantidad, $total, $pedidoID);
    echo "<div class='alert-container'>";
    if ($stmt->execute()) {
        echo "<div class='alert alert-success text-center' role='alert'>Pedido actualizado exitosamente.</div>";
    } else {
        echo "<div class='alert alert-danger text-center' role='alert'>Error al actualizar el pedido: " . $stmt->error . "</div>";
    }
    echo "</div>";
        
}

// Obtener los detalles del pedido
$selectQuery = "SELECT a.PedidoID, b.NombreCompleto, c.Nombre AS Producto, a.FechaPedido, a.Cantidad, a.Estado, a.Total, a.ProductoID
FROM viv_pedidos a
LEFT JOIN viv_perfilesusuario b ON b.UsuarioID = a.UsuarioID
LEFT JOIN viv_productos c ON c.ProductoID = a.ProductoID
WHERE PedidoID = ?";
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

// Obtener los productos disponibles
$productosQuery = "SELECT ProductoID, Nombre FROM viv_productos";
$productosResult = $conexion->query($productosQuery);
?>

    <div class="container my-4">
        <h2>Editar Pedido</h2>
        <div class="row">
            <div class="col-md-6">
                <form method="POST">
                    <div class="row mb-3">
                        <label for="producto" class="col-sm-4 col-form-label">Producto</label>
                        <div class="col-sm-8">
                        <input type="text" id="producto" class="form-control" value="<?php echo htmlspecialchars($pedido['Producto']); ?>" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="estado" class="col-sm-4 col-form-label">Estado</label>
                        <div class="col-sm-8">
                            <select id="estado" name="estado" class="form-select" required>
                                <option value="">Selecciona un estado</option>
                                <option value="Pendiente" <?php echo ($pedido['Estado'] === 'Pendiente') ? 'selected' : ''; ?>>Pendiente</option>
                                <option value="Enviado" <?php echo ($pedido['Estado'] === 'Enviado') ? 'selected' : ''; ?>>Enviado</option>
                                <option value="Entregado" <?php echo ($pedido['Estado'] === 'Entregado') ? 'selected' : ''; ?>>Entregado</option>
                                <option value="Cancelado" <?php echo ($pedido['Estado'] === 'Cancelado') ? 'selected' : ''; ?>>Cancelado</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="cantidad" class="col-sm-4 col-form-label">Cantidad</label>
                        <div class="col-sm-8">
                            <input type="number" id="cantidad" name="cantidad" class="form-control" value="<?php echo htmlspecialchars($pedido['Cantidad']); ?>" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="total" class="col-sm-4 col-form-label">Total</label>
                        <div class="col-sm-8">
                            <input type="number" id="total" name="total" class="form-control" value="<?php echo htmlspecialchars($pedido['Total']); ?>" required>
                        </div>
                    </div>
                    <input type="hidden" name="pedidoID" value="<?php echo htmlspecialchars($pedidoID); ?>">
                    <button type="submit" class="btn btn-primary ">Actualizar Pedido</button>
                </form>
            </div>

            <div class="col-md-6">
                <h2>Detalles del Pedido #<?php echo htmlspecialchars($pedidoID); ?></h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Campo</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Usuario</td>
                            <td><?php echo htmlspecialchars($pedido['NombreCompleto']); ?></td>
                        </tr>
                        <tr>
                            <td>Producto</td>
                            <td><?php echo htmlspecialchars($pedido['Producto']); ?></td>
                        </tr>
                        <tr>
                            <td>Estado</td>
                            <td><?php echo htmlspecialchars($pedido['Estado']); ?></td>
                        </tr>
                        <tr>
                            <td>Cantidad</td>
                            <td><?php echo htmlspecialchars($pedido['Cantidad']); ?></td>
                        </tr>
                        <tr>
                            <td>Total</td>
                            <td><?php echo htmlspecialchars($pedido['Total']); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <a href="logout.php" class="btn btn-danger">Cerrar Sesión</a>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <button class="btn btn-success" onclick="window.location.href='Desarrolladores.html';">Desarrolladores</button>
            <p>&copy; 2024 Vivero Plantas Vida. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>