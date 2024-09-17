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

    <!-- Sección de bienvenida -->
    <section id="inicio">
        <div class="container">
            <h4>Bienvenido al Vivero Plantas Nueva Vida</h4>
            <p>Nos alegra tenerte aquí. En nuestro vivero, encontrarás una amplia variedad de plantas y flores que transformarán tu hogar en un paraíso verde. Ya sea que busques plantas ornamentales, flores exóticas o accesorios de jardinería, estamos aquí para ayudarte a encontrar lo que necesitas. Explora nuestra colección y déjate inspirar por la belleza de la naturaleza. ¡Gracias por visitarnos y esperamos que disfrutes de tu experiencia con nosotros!</p>
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
    
</section>

<!-- Sección de testimonios -->
<section class="testimonial-section">
    <div class="container">
        <h4>Lo Que Dicen Nuestros Clientes</h4>
        <div class="row">
            <div class="col-md-4 testimonial-card">
                <div class="card">
                    <div class="card-body">
                        <p class="card-text">"¡Una experiencia maravillosa! Las plantas son hermosas y el servicio es excepcional. ¡Recomiendo este vivero al 100%!"</p>
                        <footer class="blockquote-footer">Ana López</footer>
                    </div>
                </div>
            </div>
            <div class="col-md-4 testimonial-card">
                <div class="card">
                    <div class="card-body">
                        <p class="card-text">"Excelente variedad y calidad. Me encantaron los productos y la atención personalizada fue excelente."</p>
                        <footer class="blockquote-footer">Carlos Mendoza</footer>
                    </div>
                </div>
            </div>
            <div class="col-md-4 testimonial-card">
                <div class="card">
                    <div class="card-body">
                        <p class="card-text">"Siempre encuentro lo que necesito aquí. Las plantas están en perfecto estado y el personal es muy amable."</p>
                        <footer class="blockquote-footer">María Rodríguez</footer>
                    </div>
                </div>
            </div>
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
