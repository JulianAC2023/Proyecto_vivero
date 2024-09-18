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
                    <a class="nav-link" href="Configuracion.php">Configuración</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Soporte.php">Soporte</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Panel de Control -->
    <section id="dashboard" class="container my-4">
        <h2>Estado de los pedidos</h2>

        <!-- Filtros -->
        <form method="GET" class="mb-4">
            <div class="row">
            <div class="col-md-4 mb-3">
                    <label for="estado" class="form-label">Filtrar por Estado</label>
                    <select id="estado" name="estado" class="form-select">
                        <option value="">Selecciona un estado</option>
                        <?php
                        // Incluir el archivo de conexión
                        include 'connection.php'; // Asegúrate de que 'index.php' contiene la conexión correcta

                        // Consulta para obtener los estados únicos
                        $estadoConsulta = "SELECT DISTINCT Estado FROM viv_pedidos";
                        $resultadoEstados = $conexion->query($estadoConsulta);

                        if ($resultadoEstados) {
                            while ($filaEstado = $resultadoEstados->fetch_assoc()) {
                                $estadoValor = htmlspecialchars($filaEstado["Estado"]);
                                $selected = (isset($_GET['estado']) && $_GET['estado'] == $estadoValor) ? 'selected' : '';
                                echo "<option value=\"$estadoValor\" $selected>$estadoValor</option>";
                            }
                        } else {
                            echo "<option value=''>Error al cargar estados</option>";
                        }

                        // Cerrar el resultado de la consulta
                        $resultadoEstados->free();
                        ?>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="pedidoID" class="form-label">Filtrar por Pedido ID</label>
                    <input type="text" id="pedidoID" name="pedidoID" class="form-control form-control-sm " value="<?php echo isset($_GET['pedidoID']) ? htmlspecialchars($_GET['pedidoID']) : ''; ?>" placeholder="Buscar por ID de pedido">
                </div>
                <div class="col-md-4 mb-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </div>
            </div>
        </form>

        <!-- Contenedor centrado para la tabla -->
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <?php
                    // Incluir el archivo de conexión
                    include 'connection.php'; // Asegúrate de que 'index.php' contiene la conexión correcta

                    // Obtener filtros
                    $estado = isset($_GET['estado']) ? $_GET['estado'] : '';
                    $pedidoID = isset($_GET['pedidoID']) ? $_GET['pedidoID'] : '';

                    // Crear consulta SQL con filtros
                    $consulta = "SELECT a.PedidoID, b.NombreCompleto, c.Nombre AS Producto, a.Cantidad, a.FechaPedido, a.Total, a.Estado
                                  FROM viv_pedidos a
                                  LEFT JOIN viv_perfilesusuario b ON b.UsuarioID = a.UsuarioID
                                  LEFT JOIN viv_productos c ON c.ProductoID = a.ProductoID
                                  WHERE 1=1";
                    
                    if ($estado) {
                        $consulta .= " AND a.Estado LIKE '%" . $conexion->real_escape_string($estado) . "%'";
                    }
                    if ($pedidoID) {
                        $consulta .= " AND a.PedidoID LIKE '%" . $conexion->real_escape_string($pedidoID) . "%'";
                    }

                    $resultado = $conexion->query($consulta);

                    if (!$resultado) {
                        die("Error en la consulta: " . $conexion->error);
                    }

                    if ($resultado->num_rows > 0) {
                        echo "<table class='table table-striped table-bordered'>";
                        echo "<thead><tr><th>PedidoID</th><th>NombreCompleto</th><th>Producto</th><th>Cantidad</th><th>FechaPedido</th><th>Total</th><th>Estado</th><th>Acción</th></tr></thead>";
                        echo "<tbody>";
                        while ($fila = $resultado->fetch_assoc()) {
                            $pedidoID = htmlspecialchars($fila["PedidoID"]);
                            echo "<tr>
                                    <td>" . $pedidoID . "</td>
                                    <td>" . htmlspecialchars($fila["NombreCompleto"]) . "</td>
                                    <td>" . htmlspecialchars($fila["Producto"]) . "</td>
                                    <td>" . htmlspecialchars($fila["Cantidad"]) . "</td>
                                    <td>" . htmlspecialchars($fila["FechaPedido"]) . "</td>
                                    <td>" . htmlspecialchars($fila["Total"]) . "</td>
                                    <td>" . htmlspecialchars($fila["Estado"]) . "</td>
                                    <td><a href='editar_pedido.php?PedidoID=$pedidoID' class='btn btn-warning btn-sm'>Editar</a></td>
                                  </tr>";
                        }
                        echo "</tbody></table>";
                    } else {
                        echo "<p>No se encontraron resultados.</p>";
                    }

                    // Cerrar la conexión
                    $conexion->close();
                    ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Cerrar sesión -->
    <div class="container mt-5">
        <a href="logout.php" class="btn btn-danger">Cerrar Sesión</a>
    </div>

<!-- Footer -->
<footer>
    <div class="container">
        <button class="btn btn-success" onclick="window.location.href='Desarrolladores.html';">Desarrolladores</button>
        <p>&copy; 2024 Vivero Plantas Nuevas Vida. Todos los derechos reservados.</p>
    </div>
</footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
