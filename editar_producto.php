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
                    <a class="nav-link" href="Configuracion.php">Configuración</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Soporte.php">Soporte</a>
                </li>
            </ul>
        </div>
    </nav>

<?php
include 'index.php'; // Conexión a la base de datos

// Obtener el ID del producto
$producto_id = isset($_GET['ProductoID']) ? intval($_GET['ProductoID']) : 0;

// Si se ha enviado el formulario de edición
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $valor = $_POST['valor'];
    $cantidad_disponible = $_POST['cantidad_disponible'];
    $fecha_registro = $_POST['fecha_registro'];
    $categoria_id = $_POST['categoria_id'];
    $proveedor_id = $_POST['proveedor_id'];

    // Actualizar los datos del producto en la base de datos
    $consulta = "UPDATE productos SET 
                    Nombre = '$nombre', 
                    Descripcion = '$descripcion', 
                    Valor = '$valor', 
                    CantidadDisponible = '$cantidad_disponible', 
                    FechaRegistro = '$fecha_registro', 
                    CategoriaID = '$categoria_id', 
                    ProveedorID = '$proveedor_id' 
                WHERE ProductoID = $producto_id";

    if ($conexion->query($consulta)) {
        echo "<p>Producto actualizado con éxito.</p>";
    } else {
        echo "<p>Error al actualizar el producto: " . $conexion->error . "</p>";
    }
}

// Obtener los datos del producto
$consulta = "SELECT * FROM productos WHERE ProductoID = $producto_id";
$resultado = $conexion->query($consulta);
$producto = $resultado->fetch_assoc();

// Obtener las categorías de la base de datos
$categorias = $conexion->query("SELECT CategoriaID, Nombre FROM categorias");

// Obtener los proveedores de la base de datos
$proveedores = $conexion->query("SELECT ProveedorID, Nombre FROM proveedores");
?>

<body>
    <div class="container mt-5">
        <h2>Editar Producto</h2>
        <form action="editar_producto.php?ProductoID=<?php echo $producto_id; ?>" method="POST">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" value="<?php echo htmlspecialchars($producto['Nombre']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea name="descripcion" class="form-control" required><?php echo htmlspecialchars($producto['Descripcion']); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="valor" class="form-label">Valor</label>
                <input type="number" name="valor" class="form-control" value="<?php echo htmlspecialchars($producto['Valor']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="cantidad_disponible" class="form-label">Cantidad Disponible</label>
                <input type="number" name="cantidad_disponible" class="form-control" value="<?php echo htmlspecialchars($producto['CantidadDisponible']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="fecha_registro" class="form-label">Fecha de Registro</label>
                <input type="date" name="fecha_registro" class="form-control" value="<?php echo htmlspecialchars($producto['FechaRegistro']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="categoria_id" class="form-label">Categoría</label>
                <select name="categoria_id" class="form-select" required>
                    <?php
                    while ($categoria = $categorias->fetch_assoc()) {
                        echo "<option value='" . $categoria['CategoriaID'] . "'" . ($categoria['CategoriaID'] == $producto['CategoriaID'] ? ' selected' : '') . ">" . $categoria['Nombre'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="proveedor_id" class="form-label">Proveedor</label>
                <select name="proveedor_id" class="form-select" required>
                    <?php
                    while ($proveedor = $proveedores->fetch_assoc()) {
                        echo "<option value='" . $proveedor['ProveedorID'] . "'" . ($proveedor['ProveedorID'] == $producto['ProveedorID'] ? ' selected' : '') . ">" . $proveedor['Nombre'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            <a href="Gestion de productos.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conexion->close();
?>