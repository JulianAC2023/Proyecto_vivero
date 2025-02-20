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

<!-- Modal para confirmación de creación -->
<div class="modal fade" id="confirmCreateModal" tabindex="-1" aria-labelledby="confirmCreateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmCreateModalLabel">Confirmar Creación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas crear este producto?
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
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $valor = $_POST['valor'];
        $cantidad = $_POST['cantidad'];
        $categoriaID = $_POST['categoria'];
        $proveedorID = $_POST['proveedor'];

        // Manejo de la imagen
        $target_dir = "C:/xampp/htdocs/proyecto_vivero/Multimedia/"; // Directorio donde se guardará la imagen
        $image_name = pathinfo($_FILES["imagen"]["name"], PATHINFO_FILENAME); // Nombre sin extensión
        $target_file = $target_dir . $image_name . ".jpg"; // Cambiar la extensión a .jpg
        $relative_path = "Multimedia/" . $image_name . ".jpg"; // Ruta relativa
        $uploadOk = 1;

        // Obtener el tipo de archivo
        $imageFileType = strtolower(pathinfo($_FILES["imagen"]["name"], PATHINFO_EXTENSION));

     // Verificar si la imagen es un archivo de imagen real
     $check = getimagesize($_FILES["imagen"]["tmp_name"]);
     if ($check === false) {
         echo "<div class='alert-container'><div class='alert alert-danger text-center' role='alert'>El archivo no es una imagen.</div></div>";
         $uploadOk = 0;
     }
     
     // Verificar si el archivo ya existe
     if (file_exists($target_file)) {
         echo "<div class='alert-container'><div class='alert alert-danger text-center' role='alert'>Lo sentimos, el archivo ya existe.</div></div>";
         $uploadOk = 0;
     }
     
     // Verificar el tamaño de la imagen
     if ($_FILES["imagen"]["size"] > 500000) { // 500KB
         echo "<div class='alert-container'><div class='alert alert-danger text-center' role='alert'>Lo sentimos, el archivo es demasiado grande.</div></div>";
         $uploadOk = 0;
     }
     
     // Permitir ciertos formatos de archivo
     if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif") {
         echo "<div class='alert-container'><div class='alert alert-danger text-center' role='alert'>Lo sentimos, solo se permiten archivos JPG, JPEG, PNG y GIF.</div></div>";
         $uploadOk = 0;
     }
     
     // Verificar si se puede subir el archivo
     if ($uploadOk == 1) {
         if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
             // Insertar en la base de datos
             $sql = "INSERT INTO viv_productos (Nombre, Descripcion, Valor, CantidadDisponible, CategoriaID, ProveedorID, URL_Imagen) VALUES (?, ?, ?, ?, ?, ?, ?)";
             $stmt = $conexion->prepare($sql);
             $stmt->bind_param("ssdiiss", $nombre, $descripcion, $valor, $cantidad, $categoriaID, $proveedorID, $relative_path); // Usa la ruta relativa
     
             if ($stmt->execute()) {
                 echo "<div class='alert-container'><div class='alert alert-success text-center' role='alert'>Producto agregado con éxito. <a href='Main_admin.php' class='alert-link'>Volver al panel</a></div></div>";
             } else {
                 echo "<div class='alert-container'><div class='alert alert-danger text-center' role='alert'>Error al agregar el producto: " . htmlspecialchars($stmt->error) . "</div></div>";
             }
     
             $stmt->close();
         } else {
             echo "<div class='alert-container'><div class='alert alert-danger text-center' role='alert'>Error al subir el archivo.</div></div>";
         }
     }

    }

    $categorias = $conexion->query("SELECT CategoriaID, Nombre FROM viv_categorias");
    $proveedores = $conexion->query("SELECT ProveedorID, Nombre FROM viv_proveedores");
    $conexion->close();
    ?>

    <div class="container my-4">
        <h2>Agregar Nuevo Producto</h2>
        <form id="productForm" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea name="descripcion" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
                <label for="valor" class="form-label">Valor</label>
                <input type="number" name="valor" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="cantidad" class="form-label">Cantidad Disponible</label>
                <input type="number" name="cantidad" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="categoria" class="form-label">Categoría</label>
                <select name="categoria" class="form-select" required>
                    <?php while ($categoria = $categorias->fetch_assoc()): ?>
                        <option value="<?= htmlspecialchars($categoria['CategoriaID']) ?>"><?= htmlspecialchars($categoria['Nombre']) ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="proveedor" class="form-label">Proveedor</label>
                <select name="proveedor" class="form-select" required>
                    <?php while ($proveedor = $proveedores->fetch_assoc()): ?>
                        <option value="<?= htmlspecialchars($proveedor['ProveedorID']) ?>"><?= htmlspecialchars($proveedor['Nombre']) ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="imagen" class="form-label">Cargar Imagen</label>
                <input type="file" name="imagen" class="form-control" required>
            </div>
            <button type="button" class="btn btn-primary" id="submitBtn">Agregar Producto</button>
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
                var form = document.getElementById('productForm');
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
