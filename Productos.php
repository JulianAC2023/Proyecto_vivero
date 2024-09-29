<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="Styles.css">
</head>
<body>

    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-light bg-gray">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="index.html">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="Productos.php">Productos</a></li>
                    <li class="nav-item"><a class="nav-link" href="Login.html">Iniciar Sesión</a></li>
                    <li class="nav-item"><a class="nav-link" href="Registro.html">Registrarse</a></li>
                    <li class="nav-item"><a class="nav-link" href="Carrito.html">Carrito</a></li>
                    <li class="nav-item"><a class="nav-link" href="Contacto.html">Contacto</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sección de productos -->
    <section id="productos">
    <div class="container">
        <h4>Nuestros Productos</h4>

        <!-- Filtros -->
        <form method="GET" class="mb-3">
            <div class="row">
                <div class="col-md-4">
                    <select name="categoria_id" class="form-select">
                        <option value="">Seleccionar Categoría</option>
                        <?php
                        include 'connection.php';

                        $categorias = $conexion->query("SELECT CategoriaID, Nombre FROM viv_categorias");
                        while ($categoria = $categorias->fetch_assoc()) {
                            echo "<option value='" . $categoria['CategoriaID'] . "'>" . $categoria['Nombre'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="number" name="min_valor" class="form-control" placeholder="Valor Mínimo">
                </div>
                <div class="col-md-4">
                    <input type="number" name="max_valor" class="form-control" placeholder="Valor Máximo">
                </div>
                <div class="col-md-4 mt-2">
                    <input type="text" name="palabras_clave" class="form-control" placeholder="Palabras Clave">
                </div>
                <div class="col-md-12 mt-2 bt-sm">
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </div>
            </div>
        </form>

        <div class="row">
            <?php
            // Captura de filtros
            $categoria_id = isset($_GET['categoria_id']) ? $_GET['categoria_id'] : '';
            $min_valor = isset($_GET['min_valor']) && $_GET['min_valor'] !== '' ? $_GET['min_valor'] : 0;
            $max_valor = isset($_GET['max_valor']) && $_GET['max_valor'] !== '' ? $_GET['max_valor'] : PHP_INT_MAX;
            $palabras_clave = isset($_GET['palabras_clave']) ? $_GET['palabras_clave'] : '';

            // Construcción de la consulta SQL
            $sql = "SELECT CategoriaID, Nombre, Descripcion, Valor, URL_Imagen FROM viv_productos WHERE Valor BETWEEN ? AND ?";
            $params = [$min_valor, $max_valor];
            $types = "dd"; // 'd' para dobles

            if ($categoria_id) {
                $sql .= " AND CategoriaID = ?";
                $params[] = $categoria_id;
                $types .= "i"; // 'i' para enteros
            }

            if (!empty($palabras_clave)) {
                $palabras_clave_param = "%" . $conexion->real_escape_string($palabras_clave) . "%";
                $sql .= " AND (Nombre LIKE ? OR Descripcion LIKE ?)";
                $params[] = $palabras_clave_param;
                $params[] = $palabras_clave_param;
                $types .= "ss"; // 's' para strings
            }

            // Preparar y ejecutar la consulta
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param($types, ...$params);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Formatear el valor para mostrarlo sin decimales y con separador de miles
                    $valor_formateado = number_format($row["Valor"], 0, '.', ',');
                    echo '<div class="col-md-6 col-lg-2 col-sm-12 mt-2">';
                    echo '    <div class="card">';
                    echo '        <img src="http://localhost/proyecto_vivero/' . htmlspecialchars($row["URL_Imagen"], ENT_QUOTES, 'UTF-8') . '" class="card-img-top w-100 img-fluid" alt="' . htmlspecialchars($row["Nombre"], ENT_QUOTES, 'UTF-8') . '">';
                    echo '        <div class="card-body">';
                    echo '            <h5 class="card-title">' . htmlspecialchars($row["Nombre"], ENT_QUOTES, 'UTF-8') . '</h5>';
                    echo '            <p class="card-text description">' . htmlspecialchars($row["Descripcion"], ENT_QUOTES, 'UTF-8') . '</p>';
                    echo '        </div>';
                    echo '        <div class="card-footer">';
                    echo '            <p class="card-text"><strong>Precio:</strong> $' . $valor_formateado . '</p>';
                    echo '            <button class="btn btn-outline-success agregar-carrito" data-nombre="' . htmlspecialchars($row["Nombre"], ENT_QUOTES, 'UTF-8') . '" data-precio="' . $row["Valor"] . '">Agregar al carrito</button>';
                    echo '        </div>';
                    echo '    </div>';
                    echo '</div>';
                }
            } else {
                echo '<div class="col-12">No hay productos que coincidan con los criterios de búsqueda.</div>';
            }

            $stmt->close();
            $conexion->close();
            ?>
        </div>
    </div>
</section>


    <div id="pantallazo">
        <button id="toggleBtn">Hablar a WhatsApp</button>
        <div id="contenido" style="display: none;">
            <h2>¡Hola! ¿En qué puedo ayudarte?</h2>
            <p>Escríbenos por WhatsApp para obtener asistencia inmediata.</p>
            <a href="https://wa.me/tunumerodetelefono" target="_blank" class="whatsapp-btn">
                <img src="Multimedia/Wathsapp.jpg" alt="WhatsApp" width="50" height="50">
            </a>
        </div>
    </div>

<!-- Botones de redes sociales -->
<div class="redes-sociales">
    <a href="https://www.facebook.com/" class="icon-facebook"></a>
    <a href="https://x.com/" class="icon-twitter"></a>
    <a href="https://www.instagram.com/" class="icon-instagram"></a>
</div>    

    <!-- Footer -->
    <footer>
        <div class="container">
            <button class="btn btn-success" onclick="window.location.href='Desarrolladores.html';">Desarrolladores</button>
            <p>&copy; 2024 Vivero Plantas Nueva Vida. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const toggleBtn = document.getElementById("toggleBtn");
            const contenido = document.getElementById("contenido");
            
            toggleBtn.addEventListener("click", function() {
                contenido.style.display = contenido.style.display === "none" ? "block" : "none";
            });
        });
    </script>

</body>
</html>
