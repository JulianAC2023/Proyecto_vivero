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
    <title>Panel de Control</title>
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
    <!-- Modal para confirmación de eliminación -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar este producto?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteButton">Eliminar</button>
                </div>
            </div>
        </div>
    </div>

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

        <!-- Manejo de alertas -->
        <div class="container mt-3">
        <?php if (isset($_GET['mensaje'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo htmlspecialchars($_GET['mensaje']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo htmlspecialchars($_GET['error']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
    </div>

    <div class='alert-container'>
    <?php if (isset($_SESSION['mensaje'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo htmlspecialchars($_SESSION['mensaje']); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['mensaje']); // Limpiar mensaje después de mostrar ?>
    <?php endif; ?>
    
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo htmlspecialchars($_SESSION['error']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['error']); // Limpiar mensaje después de mostrar ?>
    <?php endif; ?>
    </div>

    
    <section id="dashboard" class="container my-4">
        <h2>Estado de productos</h2>
        <div class="row mb-4">
            <div class="col-md-4">
                <button class="btn btn-success" onclick="window.location.href='agregar_producto.php';">Agregar Producto</button>
            </div>
        </div>

        <!-- Formulario de filtros -->
        <form method="GET" class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <label for="productoID">ID producto</label>
                    <select name="productoID" id="productoID" class="form-select form-select-sm">
                        <option value="">Todos</option>
                        <?php
                        include 'connection.php';
                        $productosID = $conexion->query("SELECT DISTINCT ProductoID FROM viv_productos");
                        while ($productoID = $productosID->fetch_assoc()) {
                            echo "<option value='" . htmlspecialchars($productoID['ProductoID']) . "'>" . htmlspecialchars($productoID['ProductoID']) . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="nombreProducto">Nombre producto</label>
                    <select name="nombreProducto" id="nombreProducto" class="form-select form-select-sm">
                        <option value="">Todos</option>
                        <?php
                        $nombresProductos = $conexion->query("SELECT DISTINCT Nombre FROM viv_productos");
                        while ($nombreProducto = $nombresProductos->fetch_assoc()) {
                            echo "<option value='" . htmlspecialchars($nombreProducto['Nombre']) . "'>" . htmlspecialchars($nombreProducto['Nombre']) . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="categoria">Categoría</label>
                    <select name="categoria" id="categoria" class="form-select form-select-sm">
                        <option value="">Todas</option>
                        <?php
                        $categorias = $conexion->query("SELECT CategoriaID, Nombre FROM viv_categorias");
                        while ($categoria = $categorias->fetch_assoc()) {
                            echo "<option value='" . htmlspecialchars($categoria['CategoriaID']) . "'>" . htmlspecialchars($categoria['Nombre']) . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="proveedor">Proveedor</label>
                    <select name="proveedor" id="proveedor" class="form-select form-select-sm">
                        <option value="">Todos</option>
                        <?php
                        $proveedores = $conexion->query("SELECT DISTINCT ProveedorID, Nombre FROM viv_proveedores");
                        while ($proveedor = $proveedores->fetch_assoc()) {
                            echo "<option value='" . htmlspecialchars($proveedor['ProveedorID']) . "'>" . htmlspecialchars($proveedor['Nombre']) . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="min_valor">Valor mínimo</label>
                    <input type="number" name="min_valor" id="min_valor" class="form-control form-select-sm">
                </div>
                <div class="col-md-4">
                    <label for="max_valor">Valor máximo</label>
                    <input type="number" name="max_valor" id="max_valor" class="form-control form-select-sm">
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>
            </div>
        </form>

        <!-- Contenedor centrado para la tabla -->
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <?php
                    // Obtener filtros
                    $productoID = isset($_GET['productoID']) ? $_GET['productoID'] : '';
                    $nombreProducto = isset($_GET['nombreProducto']) ? $_GET['nombreProducto'] : '';
                    $categoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';
                    $proveedor = isset($_GET['proveedor']) ? $_GET['proveedor'] : '';
                    $min_valor = isset($_GET['min_valor']) && $_GET['min_valor'] !== '' ? $_GET['min_valor'] : 0;
                    $max_valor = isset($_GET['max_valor']) && $_GET['max_valor'] !== '' ? $_GET['max_valor'] : PHP_INT_MAX;

                    // Crear consulta SQL con filtros
                    $consulta = "SELECT a.ProductoID, a.URL_Imagen, a.Nombre, a.Descripcion, a.Valor, a.CantidadDisponible, b.Nombre AS Categoria, c.Nombre AS Proveedor 
                                 FROM viv_productos a
                                 LEFT JOIN viv_categorias b ON b.CategoriaID = a.CategoriaID
                                 LEFT JOIN viv_proveedores c ON c.ProveedorID = a.ProveedorID
                                 WHERE a.Valor BETWEEN $min_valor AND $max_valor";
                    
                    if ($productoID) {
                        $consulta .= " AND a.ProductoID LIKE '%" . $conexion->real_escape_string($productoID) . "%'";
                    }
                    if ($nombreProducto) {
                        $consulta .= " AND a.Nombre LIKE '%" . $conexion->real_escape_string($nombreProducto) . "%'";
                    }
                    if ($categoria) {
                        $consulta .= " AND a.CategoriaID = '" . $conexion->real_escape_string($categoria) . "'";
                    }
                    if ($proveedor) {
                        $consulta .= " AND a.ProveedorID = '" . $conexion->real_escape_string($proveedor) . "'";
                    }

                    $resultado = $conexion->query($consulta);

                    if (!$resultado) {
                        die("Error en la consulta: " . $conexion->error);
                    }

                    if ($resultado->num_rows > 0) {
                        echo "<table class='table table-striped table-bordered'>";
                        echo "<thead><tr><th>ProductoID</th><th>Imagen</th><th>Nombre</th><th>Descripción</th><th>Valor</th><th>Cantidad Disponible</th><th>Categoría</th><th>Proveedor</th><th>Editar</th><th>Eliminar</th></tr></thead>";
                        echo "<tbody>";
                        while ($fila = $resultado->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . htmlspecialchars($fila["ProductoID"]) . "</td>
                                    <td><img src='" . htmlspecialchars($fila["URL_Imagen"]) . "' alt='Imagen de producto' style='width: 50px; height: auto;'></td>
                                    <td>" . htmlspecialchars($fila["Nombre"]) . "</td>
                                    <td>" . htmlspecialchars($fila["Descripcion"]) . "</td>
                                    <td>" . htmlspecialchars($fila["Valor"]) . "</td>
                                    <td>" . htmlspecialchars($fila["CantidadDisponible"]) . "</td>
                                    <td>" . htmlspecialchars($fila["Categoria"]) . "</td>
                                    <td>" . htmlspecialchars($fila["Proveedor"]) . "</td>
                                    <td><a href='editar_producto.php?ProductoID=" . $fila["ProductoID"] . "' class='btn btn-warning btn-sm'>Editar</a></td>
                                    <td><a href='#' class='btn btn-danger btn-sm open-confirmation' data-bs-toggle='modal' data-bs-target='#confirmDeleteModal' data-producto-id='" . $fila["ProductoID"] . "'>Eliminar</a></td>
                                  </tr>";
                        }
                        echo "</tbody></table>";
                    } else {
                        echo "<p>No se encontraron resultados.</p>";
                    }

                    $conexion->close();
                    ?>
                </div>
            </div>
        </div>
    </section>

    <script>
    let productoIdParaEliminar;

    document.addEventListener('DOMContentLoaded', function () {
        // Obtener el producto ID cuando se abre el modal
        const openConfirmationButtons = document.querySelectorAll('.open-confirmation');
        openConfirmationButtons.forEach(button => {
            button.addEventListener('click', function () {
                productoIdParaEliminar = this.getAttribute('data-producto-id');
            });
        });

        // Manejar el clic en el botón de eliminar dentro del modal
        const confirmDeleteButton = document.getElementById('confirmDeleteButton');
        confirmDeleteButton.addEventListener('click', function () {
            if (productoIdParaEliminar) {
                window.location.href = 'eliminar_producto.php?ProductoID=' + productoIdParaEliminar;
            } else {
                alert("No se ha seleccionado un producto para eliminar.");
            }
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
