<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>'Pagina principal'</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="Styles.css">
    
</head>
<body>

    <!-- Botones de redes sociales -->
<div class="redes-sociales">
    <a href="https://www.facebook.com/" class="icon-facebook"></a>
    <a href="https://x.com/" class="icon-twitter"></a>
    <a href="https://www.instagram.com/" class="icon-instagram"></a>
</div>


<!-- Barra de navegación -->
<nav class="navbar navbar-expand-lg navbar-light bg-gray">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.html">Inicio</a>
                </li>
                <!-- Menú desplegable para productos -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Productos
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="Plantas.php">Plantas</a></li>
                        <li><a class="dropdown-item" href="Accesorios.php">Accesorios</a></li>
                        <li><a class="dropdown-item" href="Abonos.php">Abonos</a></li>
                        <li><a class="dropdown-item" href="Semillas.php">Semillas</a></li>
                        <li><a class="dropdown-item" href="Herramientas.php">Herramientas</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Login.html">Iniciar Sesión</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Registro.html">Registrarse</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Carrito.html">Carrito</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Contacto.html">Contacto</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

    <!-- Sección de nuestras plantas -->
    <section id="plantas">
        <div class="container">
            <h4>Nuestras Accesorios</h4>
            <div class="row">
                <?php
                include 'connection.php'; // Incluye el archivo de conexión

                // Asegúrate de validar y sanitizar el parámetro para evitar SQL Injection
                $categoria_id = isset($_GET['categoria_id']) ? intval($_GET['categoria_id']) : 5;

                // Consulta SQL para obtener productos de la categoría especificada
                $sql = "SELECT Nombre, Descripcion, Valor, URL_Imagen FROM viv_productos WHERE CategoriaID = ?";
                $stmt = $conexion->prepare($sql);

                // Verificar si la preparación de la consulta fue exitosa
                if ($stmt === false) {
                    die('Error al preparar la consulta: ' . $conexion->error);
                }

                $stmt->bind_param("i", $categoria_id);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        // Formatear el valor para mostrarlo sin decimales y con separador de miles
                        $valor_formateado = number_format($row["Valor"], 0, '.', ',');
                        echo '    <div class="col-md-6 col-lg-2 col-sm-12 mt-2">';
                        echo '        <div class="card">';
                        echo '            <img src="http://localhost/proyecto_vivero/Multimedia/' . htmlspecialchars($row["URL_Imagen"], ENT_QUOTES, 'UTF-8') . '" class="card-img-top w-100 img-fluid" alt="' . htmlspecialchars($row["Nombre"], ENT_QUOTES, 'UTF-8') . '">';
                        echo '            <div class="card-body">';
                        echo '                <h5 class="card-title">' . htmlspecialchars($row["Nombre"], ENT_QUOTES, 'UTF-8') . '</h5>';
                        echo '                <p class="card-text description">' . htmlspecialchars($row["Descripcion"], ENT_QUOTES, 'UTF-8') . '</p>';
                        echo '            </div>';
                        echo '            <div class="card-footer">';
                        echo '                <p class="card-text"><strong>Precio:</strong> $' . $valor_formateado . '</p>';
                        echo '                <button class="btn btn-outline-success agregar-carrito" data-nombre="' . htmlspecialchars($row["Nombre"], ENT_QUOTES, 'UTF-8') . '" data-precio="' . $row["Valor"] . '">Agregar al carrito</button>';
                        echo '            </div>';
                        echo '        </div>';
                        echo '    </div>';
                    }
                } else {
                    echo "No hay productos en esta categoría.";
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
            <!-- Aquí puedes colocar el enlace de WhatsApp -->
            <a href="https://wa.me/tunumerodetelefono" target="_blank" class="whatsapp-btn"><img src="Multimedia/Wathsapp.jpg" alt="WhatsApp" width="50px" height="50px"></a>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <button class="btn btn-success" onclick="window.location.href='Desarrolladores.html';">Desarrolladores</button>
            <p>&copy; 2024 Vivero Plantas Nuevas Vida. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const toggleBtn = document.getElementById("toggleBtn");
            const contenido = document.getElementById("contenido");
            
            toggleBtn.addEventListener("click", function() {
                if (contenido.style.display === "none") {
                    contenido.style.display = "block";
                    toggleBtn.textContent = "Cerrar WhatsApp";
                } else {
                    contenido.style.display = "none";
                    toggleBtn.textContent = "Abrir WhatsApp";
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="Script.js"></script>
</body>
</html>