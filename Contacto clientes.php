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

<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <span class="navbar-text">
            Bienvenido, <?php echo htmlspecialchars($_SESSION['nombre_usuario']); ?>
        </span>
</nav>

    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-light bg-gray">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="Main.php">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="Productos clientes.php">Productos</a></li>
                    <li class="nav-item"><a class="nav-link" href="Carrito clientes.php">Carrito</a></li>
                    <li class="nav-item"><a class="nav-link" href="Contacto clientes.php">Contacto</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sección de contacto -->
    <section id="contacto">
        <div class="container">
            <h4>Contacto</h4>
            <form action="enviar.php" method="post">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="mensaje">Mensaje:</label>
                <textarea id="mensaje" name="mensaje" required></textarea>

                <button type="submit">Enviar</button>
            </form>
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
