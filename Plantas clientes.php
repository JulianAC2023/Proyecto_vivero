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

     <!-- Sección de nuestras plantas -->
     <section id="plantas">
        <div class="container">
            <h4>Nuestros Plantas</h4>
            <div class="row">
                <div class="col-md-6 col-lg-2 col-sm-12 mt-2">
                    <div class="card">
                        <img src="Multimedia/Girasol.jpg" class="card-img-top w-100 img-fluid" alt="Planta 1">
                        <div class="card-body">
                            <h5 class="card-title">Girasol</h5>
                            <p class="card-text">Los girasoles son flores que irradian vitalidad y alegría con sus brillantes pétalos dorados que siguen el movimiento del sol.</p>
                        </div>
                        <div class="card-footer">
                            <p class="card-text"><strong>Precio:</strong> $37.000</p>
                            <button class="btn btn-outline-success agregar-carrito" data-nombre="Girasol" data-precio="37000">Agregar al carrito</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-2 col-sm-12 mt-2">
                    <div class="card">
                        <img src="Multimedia/Clavel.jpg" class="card-img-top w-100 img-fluid" alt="Planta 2">
                        <div class="card-body">
                            <h5 class="card-title">Clavel</h5>
                            <p class="card-text">Los claveles son flores que destacan por su elegancia y gracia. Con una amplia gama de colores y variedades, cada clavel es una expresión de belleza cultivada con cuidado y atención al detalle.</p>
                        </div>
                        <div class="card-footer">
                            <p class="card-text"><strong>Precio:</strong> $18.500</p>
                            <button class="btn btn-outline-success agregar-carrito" data-nombre="clavel" data-precio="18500">Agregar al carrito</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-2 col-sm-12 mt-2">
                    <div class="card">
                        <img src="Multimedia/Bonsai.jpg" class="card-img-top w-100 img-fluid" alt="Planta 3">
                        <div class="card-body">
                            <h5 class="card-title">Bonsai</h5>
                            <p class="card-text">Los bonsáis son árboles cultivados en macetas que representan la belleza y la armonía de la naturaleza en miniatura. Cada bonsái es una expresión única de cuidado y paciencia, capturando la majestuosidad de árboles más grandes en un espacio reducido.</p>
                        </div>
                        <div class="card-footer">
                            <p class="card-text"><strong>Precio:</strong> $74.000</p>
                            <button class="btn btn-outline-success agregar-carrito" data-nombre="Bonsai" data-precio="74000">Agregar al carrito</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-2 col-sm-12 mt-2">
                    <div class="card">
                        <img src="Multimedia/Anturio.jpg" class="card-img-top w-100 img-fluid" alt="Planta 4">
                        <div class="card-body">
                            <h5 class="card-title">Anturio</h5>
                            <p class="card-text">El anturio es una planta exótica conocida por sus llamativas inflorescencias y brillantes hojas. Originario de las selvas tropicales, el anturio agrega un toque de sofisticación a cualquier entorno. Cultivado con esmero, cada anturio es una obra de arte viviente lista para embellecer tu hogar con su singular belleza.</p>
                        </div>
                        <div class="card-footer">
                            <p class="card-text"><strong>Precio:</strong> $55.500</p>
                            <button class="btn btn-outline-success agregar-carrito" data-nombre="Anturio" data-precio="55500">Agregar al carrito</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-2 col-sm-12 mt-2">
                    <div class="card">
                        <img src="Multimedia/Rosas.jpg" class="card-img-top w-100 img-fluid" alt="Planta 5">
                        <div class="card-body">
                            <h5 class="card-title">Rosas</h5>
                            <p class="card-text">Belleza y elegancia en una flor, ideal para expresar sentimientos profundos o añadir un toque clásico al jardín.</p>
                        </div>
                        <div class="card-footer">
                            <p class="card-text"><strong>Precio:</strong> $18.500</p>
                            <button class="btn btn-outline-success agregar-carrito" data-nombre="Rosas" data-precio="18500">Agregar al carrito</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-2 col-sm-12 mt-2">
                    <div class="card">
                        <img src="Multimedia/Orquidea.jpg" class="card-img-top w-100 img-fluid" alt="Planta 5">
                        <div class="card-body">
                            <h5 class="card-title">Orquidea</h5>
                            <p class="card-text">Exótica y sofisticada, la orquídea aporta un toque de lujo y color vibrante a cualquier espacio, ideal para ocasiones especiales.</p>
                        </div>
                        <div class="card-footer">
                            <p class="card-text"><strong>Precio:</strong> $35.000</p>
                            <button class="btn btn-outline-success agregar-carrito" data-nombre="Orquidea" data-precio="35000">Agregar al carrito</button>
                        </div>
                    </div>
                </div>

                <!-- Agrega más productos según sea necesario -->
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
