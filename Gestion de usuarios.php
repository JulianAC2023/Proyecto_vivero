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
    <title>Gestión de Usuarios</title>
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
    <style>
        @media (max-width: 768px) {
            .table th:nth-child(n+7), 
            .table td:nth-child(n+7) {
                display: none; /* Ocultar columnas desde la séptima en pantallas pequeñas */
            }
        }
    </style>
</head>

<!-- Modal para confirmación de eliminación -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas eliminar este usuario?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteButton">Eliminar</button>
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
    
    <section id="dashboard" class="container my-4">
        <h2>Gestión de Usuarios</h2>
        <div class="row mb-4">
            <div class="col-md-4">
                <button class="btn btn-success" onclick="window.location.href='agregar_usuario.php';">Agregar Usuario</button>
            </div>
        </div>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <?php
                    include 'connection.php';

                    // Consultar todos los usuarios
                    $resultado = $conexion->query("SELECT UsuarioID, NombreUsuario, NombreCompleto, CorreoElectronico, Direccion, Telefono, ContrasenaHash, FechaRegistro, FechaUltimoAcceso, Rol, Activo FROM viv_perfilesusuario");

                    if (!$resultado) {
                        die("Error en la consulta: " . $conexion->error);
                    }

                    if ($resultado->num_rows > 0) {
                        echo "<table class='table table-striped table-bordered table-responsive'>";
                        echo "<thead><tr><th>ID</th><th>User</th><th>Name</th><th>Email</th><th>Address</th><th>Phone</th><th>Rol</th><th>Status</th><th>Editar</th><th>Eliminar</th></tr></thead>";
                        echo "<tbody>";
                        while ($fila = $resultado->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . htmlspecialchars($fila["UsuarioID"]) . "</td>
                                    <td>" . htmlspecialchars($fila["NombreUsuario"]) . "</td>
                                    <td>" . htmlspecialchars($fila["NombreCompleto"]) . "</td>
                                    <td>" . htmlspecialchars($fila["CorreoElectronico"]) . "</td>
                                    <td>" . htmlspecialchars($fila["Direccion"]) . "</td>
                                    <td>" . htmlspecialchars($fila["Telefono"]) . "</td>
                                    <td>" . htmlspecialchars($fila["Rol"]) . "</td>
                                    <td>" . htmlspecialchars($fila["Activo"]) . "</td>
                                    <td><a href='editar_usuario.php?UsuarioID=" . $fila["UsuarioID"] . "' class='btn btn-warning btn-sm'>Editar</a></td>
                                    <td><a href='eliminar_usuario.php?UsuarioID=' class='btn btn-danger btn-sm open-confirmation' data-user-id='" . $fila["UsuarioID"] . "' data-bs-toggle='modal' data-bs-target='#confirmDeleteModal'>Eliminar</a></td>
                                  </tr>";
                        }
                        echo "</tbody></table>";
                    } else {
                        echo "<p>No se encontraron usuarios.</p>";
                    }

                    $conexion->close();
                    ?>
                </div>
            </div>
        </div>
    </section>

    <script>
    let userIdParaEliminar;

        document.addEventListener('DOMContentLoaded', function () {
            const openConfirmationButtons = document.querySelectorAll('.open-confirmation');
            openConfirmationButtons.forEach(button => {
                button.addEventListener('click', function () {
                    userIdParaEliminar = this.getAttribute('data-user-id');
                });
            });
        
            const confirmDeleteButton = document.getElementById('confirmDeleteButton');
            confirmDeleteButton.addEventListener('click', function () {
                window.location.href = 'eliminar_usuario.php?UsuarioID=' + userIdParaEliminar;
            });
        });
    </script>


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
