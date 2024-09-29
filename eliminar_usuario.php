<?php
session_start();
if (!isset($_SESSION['nombre_usuario'])) {
    header("Location: Login.html");
    exit();
}

include 'connection.php';

// Variables para el mensaje de alerta
$mensaje = '';
$tipo_alerta = '';

if (isset($_GET['UsuarioID'])) {
    $usuarioID = intval($_GET['UsuarioID']); // Asegúrate de que sea un entero.

    // Iniciar una transacción
    $conexion->begin_transaction();

    try {
        // Eliminar el usuario
        $consulta = "DELETE FROM viv_perfilesusuario WHERE UsuarioID = ?";
        $stmt = $conexion->prepare($consulta);

        if ($stmt) {
            $stmt->bind_param('i', $usuarioID);
            
            if (!$stmt->execute()) {
                throw new Exception("Error al eliminar el usuario: " . $stmt->error);
            }

            $stmt->close();
            // Confirmar la transacción
            $conexion->commit();
            $mensaje = 'Usuario eliminado con éxito.';
            $tipo_alerta = 'success';
        } else {
            throw new Exception("Error en la preparación de la consulta: " . $conexion->error);
        }
    } catch (Exception $e) {
        // Si hay un error, revertir la transacción
        $conexion->rollback();
        $mensaje = 'Error: ' . $e->getMessage();
        $tipo_alerta = 'danger';
    }
} else {
    $mensaje = 'UsuarioID no proporcionado.';
    $tipo_alerta = 'warning';
}

$conexion->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
        <span class="navbar-text">
            Bienvenido, <?php echo htmlspecialchars($_SESSION['nombre_usuario']); ?>
        </span>
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
                    <a class="nav-link" href="Main_admin.php">Gestión de Pedidos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Gestion de productos.php">Gestión de Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="Gestion de usuarios.php">Gestión de Usuarios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Soporte.php">Soporte</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <?php if ($mensaje): ?>
            <div class="alert-container">
                <div class="alert alert-<?php echo $tipo_alerta; ?> alert-dismissible fade show" role="alert">
                    <?php echo htmlspecialchars($mensaje); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            <script>
                setTimeout(function() {
                    document.querySelector('.alert-container').style.display = 'none';
                }, 5000);
            </script>
        <?php endif; ?>
        <a href="Gestion de usuarios.php" class="btn btn-secondary">Volver a la gestión de usuarios</a>
    </div>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
