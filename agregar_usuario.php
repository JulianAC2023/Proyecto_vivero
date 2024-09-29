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
    <title>Agregar Usuario</title>
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

<!-- Modal para confirmación de creación -->
<div class="modal fade" id="confirmCreateModal" tabindex="-1" aria-labelledby="confirmCreateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmCreateModalLabel">Confirmar Creación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas crear este usuario?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="confirmCreateButton">Crear</button>
            </div>
        </div>
    </div>
</div>

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

    <?php
    include 'connection.php';
    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirmar_creacion'])) {
        $nombre_usuario = $_POST['nombre_usuario'];
        $nombre_completo = $_POST['nombre_completo'];
        $correo_electronico = $_POST['correo_electronico'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $rol = $_POST['rol'];
        $activo = isset($_POST['activo']) ? 1 : 0;

        // Insertar en la base de datos
        $sql = "INSERT INTO viv_perfilesusuario (NombreUsuario, NombreCompleto, CorreoElectronico, Direccion, Telefono, Rol, Activo) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("sssssii", $nombre_usuario, $nombre_completo, $correo_electronico, $direccion, $telefono, $rol, $activo);
    
        if ($stmt->execute()) {
            echo "<div class='alert-container'><div class='alert alert-success' role='alert'>Usuario agregado con éxito. <a href='Gestion de usuarios.php' class='alert-link'>Volver a la gestión de usuarios</a></div></div>";
        } else {
            echo "<div class='alert-container'><div class='alert alert-danger' role='alert'>Error al agregar el usuario: " . htmlspecialchars($stmt->error) . "</div></div>";
        }        

        $stmt->close();
    }

    $conexion->close();
    ?>

    <div class="container my-4">
        <h2>Agregar Nuevo Usuario</h2>
        <form id="userForm" method="POST">
            <div class="mb-3">
                <label for="nombre_usuario" class="form-label">Nombre de Usuario</label>
                <input type="text" name="nombre_usuario" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="nombre_completo" class="form-label">Nombre Completo</label>
                <input type="text" name="nombre_completo" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="correo_electronico" class="form-label">Correo Electrónico</label>
                <input type="email" name="correo_electronico" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" name="direccion" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" name="telefono" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="rol" class="form-label">Rol</label>
                <select name="rol" class="form-select" required>
                    <option value="1">admin</option>
                    <option value="2">usuario</option>
                    <option value="3">invitado</option>
                </select>
            </div>
            <div class="form-check mb-3">
                <input type="checkbox" name="activo" class="form-check-input" id="activo" checked>
                <label class="form-check-label" for="activo">Activo</label>
            </div>
            <button type="button" class="btn btn-primary" id="submitBtn">Agregar Usuario</button>
        </form>
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
    <script>
        document.getElementById('submitBtn').addEventListener('click', function() {
            // Muestra el modal de confirmación
            var modal = new bootstrap.Modal(document.getElementById('confirmCreateModal'));
            modal.show();

            // Agrega un evento al botón de confirmación en el modal
            document.getElementById('confirmCreateButton').onclick = function() {
                // Al confirmar, agrega un campo oculto y envía el formulario
                var form = document.getElementById('userForm');
                var input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'confirmar_creacion';
                form.appendChild(input);
                form.submit();
            };
        });
    </script>
</body>
</html>
