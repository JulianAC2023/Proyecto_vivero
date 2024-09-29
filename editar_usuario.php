<?php
session_start();
if (!isset($_SESSION['nombre_usuario'])) {
    header("Location: Login.html");
    exit();
}

include 'connection.php'; // Conexión a la base de datos

// Obtener el ID del usuario
$usuario_id = isset($_GET['UsuarioID']) ? intval($_GET['UsuarioID']) : 0;

// Variables para el mensaje de alerta
$mensaje = '';
$tipo_alerta = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_usuario = $_POST['nombre_usuario'];
    $nombre_completo = $_POST['nombre_completo'];
    $correo_electronico = $_POST['correo_electronico'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $rol = $_POST['rol'];
    $activo = isset($_POST['activo']) ? 1 : 0;

    // Actualizar los datos del usuario en la base de datos
    $consulta = "UPDATE viv_perfilesusuario SET 
                    NombreUsuario = '$nombre_usuario', 
                    NombreCompleto = '$nombre_completo', 
                    CorreoElectronico = '$correo_electronico', 
                    Direccion = '$direccion', 
                    Telefono = '$telefono', 
                    Rol = '$rol', 
                    Activo = '$activo' 
                WHERE UsuarioID = $usuario_id";

    if ($conexion->query($consulta)) {
        $mensaje = 'Usuario actualizado con éxito.';
        $tipo_alerta = 'success';
    } else {
        $mensaje = 'Error al actualizar el usuario: ' . $conexion->error;
        $tipo_alerta = 'danger';
    }
}

// Obtener los datos del usuario
$consulta = "SELECT * FROM viv_perfilesusuario WHERE UsuarioID = $usuario_id";
$resultado = $conexion->query($consulta);
$usuario = $resultado->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
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
                    <a class="nav-link active" href="Main_admin.php">Gestión de Pedidos</a>
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

    <div class="container mt-5">
        <h2>Editar Usuario</h2>
        
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

        <form action="editar_usuario.php?UsuarioID=<?php echo $usuario_id; ?>" method="POST">
            <div class="mb-3">
                <label for="nombre_usuario" class="form-label">Nombre de Usuario</label>
                <input type="text" name="nombre_usuario" class="form-control" value="<?php echo htmlspecialchars($usuario['NombreUsuario']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="nombre_completo" class="form-label">Nombre Completo</label>
                <input type="text" name="nombre_completo" class="form-control" value="<?php echo htmlspecialchars($usuario['NombreCompleto']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="correo_electronico" class="form-label">Correo Electrónico</label>
                <input type="email" name="correo_electronico" class="form-control" value="<?php echo htmlspecialchars($usuario['CorreoElectronico']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" name="direccion" class="form-control" value="<?php echo htmlspecialchars($usuario['Direccion']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" name="telefono" class="form-control" value="<?php echo htmlspecialchars($usuario['Telefono']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="rol" class="form-label">Rol</label>
                <input type="text" name="rol" class="form-control" value="<?php echo htmlspecialchars($usuario['Rol']); ?>" required>
            </div>
            <div class="form-check mb-3">
                <input type="checkbox" name="activo" class="form-check-input" id="activo" <?php echo $usuario['Activo'] ? 'checked' : ''; ?>>
                <label class="form-check-label" for="activo">Activo</label>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            <a href="Gestion de usuarios.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>

    <footer>
        <div class="container">
            <button class="btn btn-success" onclick="window.location.href='Desarrolladores.html';">Desarrolladores</button>
            <p>&copy; 2024 Vivero Plantas Nueva Vida. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conexion->close();
?>
