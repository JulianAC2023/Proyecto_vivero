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
                        <li><a class="dropdown-item" href="Plantas.html">Plantas</a></li>
                        <li><a class="dropdown-item" href="Accesorios.html">Accesorios</a></li>
                        <li><a class="dropdown-item" href="Abonos.html">Abonos</a></li>
                        <li><a class="dropdown-item" href="Semillas.html">Semillas</a></li>
                        <li><a class="dropdown-item" href="Herramientas.html">Herramientas</a></li>
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

<!-- Sección de herramientas -->
<section id="herramientas">
    <div class="container">
        <h4>Nuestras Herramientas</h4>
        <div class="row">
            <div class="col-md-6 col-lg-2 col-sm-12 mt-2">
                <div class="card">
                    <img src="Multimedia/Botas.jpg" class="card-img-top w-100 img-fluid" alt="Botas">
                    <div class="card-body">
                        <h5 class="card-title">Botas</h5>
                        <p class="card-text">Botas resistentes y duraderas para proteger tus pies mientras trabajas en el jardín.</p>
                    </div>
                    <div class="card-footer">
                        <p class="card-text"><strong>Precio:</strong> $50.000</p>
                        <button class="btn btn-outline-success agregar-carrito" data-nombre="Botas" data-precio="50000">Agregar al carrito</button>
                    </div>
                </div>
            </div>            
            <div class="col-md-6 col-lg-2 col-sm-12 mt-2">
                <div class="card">
                    <img src="Multimedia/Pala.jpg" class="card-img-top w-100 img-fluid" alt="Pala">
                    <div class="card-body">
                        <h5 class="card-title">Pala</h5>
                        <p class="card-text">Herramienta esencial para cavar y trasladar tierra, ideal para labores de jardinería y construcción.</p>
                    </div>
                    <div class="card-footer">
                        <p class="card-text"><strong>Precio:</strong> $35.000</p>
                        <button class="btn btn-outline-success agregar-carrito" data-nombre="Pala" data-precio="35000">Agregar al carrito</button>
                    </div>
                </div>
            </div>            
            <div class="col-md-6 col-lg-2 col-sm-12 mt-2">
                <div class="card">
                    <img src="Multimedia/Llana.jpg" class="card-img-top w-100 img-fluid" alt="Llana">
                    <div class="card-body">
                        <h5 class="card-title">Llana</h5>
                        <p class="card-text">Instrumento para sembrar tus más hermosas flores pequeñas en macetas o superficies pequeñas.</p>
                    </div>
                    <div class="card-footer">
                        <p class="card-text"><strong>Precio:</strong> $20.000</p>
                        <button class="btn btn-outline-success agregar-carrito" data-nombre="Llana" data-precio="20000">Agregar al carrito</button>
                    </div>
                </div>
            </div>            
            <div class="col-md-6 col-lg-2 col-sm-12 mt-2">
                <div class="card">
                    <img src="Multimedia/Tijeras.jpg" class="card-img-top w-100 img-fluid" alt="Tijeras">
                    <div class="card-body">
                        <h5 class="card-title">Tijeras</h5>
                        <p class="card-text">Tijeras de podar afiladas y resistentes para recortar plantas y arbustos con precisión.</p>
                    </div>
                    <div class="card-footer">
                        <p class="card-text"><strong>Precio:</strong> $25.000</p>
                        <button class="btn btn-outline-success agregar-carrito" data-nombre="Tijeras" data-precio="25000">Agregar al carrito</button>
                    </div>
                </div>
            </div>            
            <div class="col-md-6 col-lg-2 col-sm-12 mt-2">
                <div class="card">
                    <img src="Multimedia/Sopla hojas.jpg" class="card-img-top w-100 img-fluid" alt="Sopla Hojas">
                    <div class="card-body">
                        <h5 class="card-title">Sopla Hojas</h5>
                        <p class="card-text">Herramienta eléctrica para limpiar hojas y residuos de jardines y patios de manera rápida y eficiente.</p>
                    </div>
                    <div class="card-footer">
                        <p class="card-text"><strong>Precio:</strong> $80.000</p>
                        <button class="btn btn-outline-success agregar-carrito" data-nombre="Sopla Hojas" data-precio="80000">Agregar al carrito</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-2 col-sm-12 mt-2">
                <div class="card">
                    <img src="Multimedia/Azada.jpg" class="card-img-top w-100 img-fluid" alt="Azada">
                    <div class="card-body">
                        <h5 class="card-title">Azada</h5>
                        <p class="card-text">Herramienta manual para cavar, romper terrones y remover la tierra en labores de jardinería y agricultura.</p>
                    </div>
                    <div class="card-footer">
                        <p class="card-text"><strong>Precio:</strong> $30.000</p>
                        <button class="btn btn-outline-success agregar-carrito" data-nombre="Azada" data-precio="30000">Agregar al carrito</button>
                    </div>
                </div>
            </div>            
            <div class="col-md-6 col-lg-2 col-sm-12 mt-2">
                <div class="card">
                    <img src="Multimedia/Podadora.jpg" class="card-img-top w-100 img-fluid" alt="Podadora">
                    <div class="card-body">
                        <h5 class="card-title">Podadora</h5>
                        <p class="card-text">Herramienta eléctrica para cortar y dar forma a setos, arbustos y bordes de césped con precisión.</p>
                    </div>
                    <div class="card-footer">
                        <p class="card-text"><strong>Precio:</strong> $120.000</p>
                        <button class="btn btn-outline-success agregar-carrito" data-nombre="Podadora" data-precio="120000">Agregar al carrito</button>
                    </div>
                </div>
            </div>          
            <div class="col-md-6 col-lg-2 col-sm-12 mt-2">
                <div class="card">
                    <img src="Multimedia/Rastrillo.jpg" class="card-img-top w-100 img-fluid" alt="Rastrillo">
                    <div class="card-body">
                        <h5 class="card-title">Rastrillo</h5>
                        <p class="card-text">Herramienta manual para recoger hojas, esparcir tierra y nivelar superficies en el jardín.</p>
                    </div>
                    <div class="card-footer">
                        <p class="card-text"><strong>Precio:</strong> $20.000</p>
                        <button class="btn btn-outline-success agregar-carrito" data-nombre="Rastrillo" data-precio="20000">Agregar al carrito</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-2 col-sm-12 mt-2">
                <div class="card">
                    <img src="Multimedia/Desbrozadora.jpg" class="card-img-top w-100 img-fluid" alt="Desbrozadora">
                    <div class="card-body">
                        <h5 class="card-title">Desbrozadora</h5>
                        <p class="card-text">Herramienta potente para cortar hierbas, malezas y arbustos en áreas grandes y difíciles de alcanzar.</p>
                    </div>
                    <div class="card-footer">
                        <p class="card-text"><strong>Precio:</strong> $180.000</p>
                        <button class="btn btn-outline-success agregar-carrito" data-nombre="Desbrozadora" data-precio="180000">Agregar al carrito</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-2 col-sm-12 mt-2">
                <div class="card">
                    <img src="Multimedia/Tenedor.jpg" class="card-img-top w-100 img-fluid" alt="Desbrozadora">
                    <div class="card-body">
                        <h5 class="card-title">Tenedor de Jardinería</h5>
                        <p class="card-text">Tenedor de jardinería de acero con cuatro dientes, ideal para airear el suelo, remover malas hierbas y trabajar en áreas pequeñas del jardín. Su diseño robusto garantiza durabilidad y facilidad de uso.</p>
                    </div>
                    <div class="card-footer">
                        <p class="card-text"><strong>Precio:</strong> $270.000</p>
                        <button class="btn btn-outline-success agregar-carrito" data-nombre="Desbrozadora" data-precio="270000">Agregar al carrito</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-2 col-sm-12 mt-2">
                <div class="card">
                    <img src="Multimedia/Cubo.jpg" class="card-img-top w-100 img-fluid" alt="Desbrozadora">
                    <div class="card-body">
                        <h5 class="card-title">Cubo de Jardinería</h5>
                        <p class="card-text">Cubo de jardinería de plástico resistente para transportar tierra, agua y otros materiales. Su diseño ergonómico y duradero es perfecto para diversas tareas en el jardín.</p>
                    </div>
                    <div class="card-footer">
                        <p class="card-text"><strong>Precio:</strong> $30.000</p>
                        <button class="btn btn-outline-success agregar-carrito" data-nombre="Desbrozadora" data-precio="30000">Agregar al carrito</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-2 col-sm-12 mt-2">
                <div class="card">
                    <img src="Multimedia/Set herramientas.jpg" class="card-img-top w-100 img-fluid" alt="Desbrozadora">
                    <div class="card-body">
                        <h5 class="card-title">Set de herramientas en acero inoxidable</h5>
                        <p class="card-text">Juego de herramientas de jardinería de acero inoxidable, con pala, azada y garra. Ergonómicas y resistentes, ideales para preparar, plantar y mantener tu jardín con facilidad..</p>
                    </div>
                    <div class="card-footer">
                        <p class="card-text"><strong>Precio:</strong> $80.000</p>
                        <button class="btn btn-outline-success agregar-carrito" data-nombre="Desbrozadora" data-precio="80000">Agregar al carrito</button>
                    </div>
                </div>
            </div>
            <!-- Agrega más herramientas según sea necesario -->
        </div>
    </div>
</section>

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

</section>

    <!-- Cerra sesion -->
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
