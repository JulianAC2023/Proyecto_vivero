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

    <!-- Sección de nuestros accesorios -->
    <section id="accesorios">
        <div class="container">
            <div class="container">
            <h4>Nuestros Accesorios</h4>
            <div class="row">
                <div class="col-md-6 col-lg-2 col-sm-12 mt-2">
                    <div class="card">
                        <img src="Multimedia/Etiqueta plastica.jpg" class="card-img-top w-100 img-fluid" alt="Etiqueta plastica">
                        <div class="card-body">
                            <h5 class="card-title">Etiqueta plastica</h5>
                            <p class="card-text">"Información esencial para identificar y cuidar tus plantas con precisión".</p>
                        </div>
                        <div class="card-footer">
                            <p class="card-text"><strong>Precio:</strong> $5.000</p>
                            <button class="btn btn-outline-success agregar-carrito" data-nombre="Etiqueta plastica" data-precio="5000">Agregar al carrito</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-2 col-sm-12 mt-2">
                    <div class="card">
                        <img src="Multimedia/Dispensador cemillas.jpg" class="card-img-top w-100 img-fluid" alt="Dispensador de semillas">
                        <div class="card-body">
                            <h5 class="card-title">Dispensador de cemillas</h5>
                            <p class="card-text">"Facilita la siembra ordenada y precisa de semillas, optimizando el proceso de cultivo y garantizando un crecimiento saludable de las plantas."</p>
                        </div>
                        <div class="card-footer">
                            <p class="card-text"><strong>Precio:</strong> $8.000</p>
                            <button class="btn btn-outline-success agregar-carrito" data-nombre="Dispensador de cemillas" data-precio="8000">Agregar al carrito</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-2 col-sm-12 mt-2">
                    <div class="card">
                        <img src="Multimedia/Regadera plastica.jpg" class="card-img-top w-100 img-fluid" alt="Regadera plastica">
                        <div class="card-body">
                            <h5 class="card-title">Regadera plastica</h5>
                            <p class="card-text">"Herramienta ligera y resistente, ideal para el riego de plantas en interiores y exteriores. Su diseño ergonómico facilita el manejo y distribución del agua de manera eficiente."</p>
                        </div>
                        <div class="card-footer">
                            <p class="card-text"><strong>Precio:</strong> $12.000</p>
                            <button class="btn btn-outline-success agregar-carrito" data-nombre="Regadera plastica" data-precio="12000">Agregar al carrito</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-2 col-sm-12 mt-2">
                    <div class="card">
                        <img src="Multimedia/Pistola de riego.jpg" class="card-img-top w-100 img-fluid" alt="Pistola de riego">
                        <div class="card-body">
                            <h5 class="card-title">Pistola de riego</h5>
                            <p class="card-text">"Herramienta esencial para el riego de plantas, ofrece control y precisión en la aplicación del agua."</p>
                        </div>
                        <div class="card-footer">
                            <p class="card-text"><strong>Precio:</strong> $14.000</p>
                            <button class="btn btn-outline-success agregar-carrito" data-nombre="Pistola de riego" data-precio="14000">Agregar al carrito</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-2 col-sm-12 mt-2">
                    <div class="card">
                        <img src="Multimedia/Kit riego.jpg" class="card-img-top w-100 img-fluid" alt="Kit riego de goteo">
                        <div class="card-body">
                            <h5 class="card-title">Kit riego de goteo</h5>
                            <p class="card-text">"Solución completa y eficiente para mantener tus plantas hidratadas con precisión y bajo consumo de agua."</p>
                        </div>
                        <div class="card-footer">
                            <p class="card-text"><strong>Precio:</strong> $25.000</p>
                            <button class="btn btn-outline-success agregar-carrito" data-nombre="Kit riego de goteo" data-precio="25000">Agregar al carrito</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-2 col-sm-12 mt-2">
                    <div class="card">
                        <img src="Multimedia/Guantes.jpg" class="card-img-top w-100 img-fluid" alt="Guantes">
                        <div class="card-body">
                            <h5 class="card-title">Guantes</h5>
                            <p class="card-text">"Protege tus manos mientras trabajas en el jardín con comodidad y durabilidad."</p>
                        </div>
                        <div class="card-footer">
                            <p class="card-text"><strong>Precio:</strong> $12.000</p>
                            <button class="btn btn-outline-success agregar-carrito" data-nombre="Guantes" data-precio="12000">Agregar al carrito</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-2 col-sm-12 mt-2">
                    <div class="card">
                        <img src="Multimedia/Delantal.jpg" class="card-img-top w-100 img-fluid" alt="Accesorio 7">
                        <div class="card-body">
                            <h5 class="card-title">Delantal de jardinería</h5>
                            <p class="card-text">"Mantén tu ropa limpia y protegida mientras trabajas en el jardín con este práctico delantal resistente."</p>
                        </div>
                        <div class="card-footer">
                            <p class="card-text"><strong>Precio:</strong> $20.000</p>
                            <button class="btn btn-outline-success agregar-carrito" data-nombre="Delantal de jardinería" data-precio="20000">Agregar al carrito</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-2 col-sm-12 mt-2">
                    <div class="card">
                        <img src="Multimedia/Maceta 14.jpg" class="card-img-top w-100 img-fluid" alt="Accesorio 8">
                        <div class="card-body">
                            <h5 class="card-title">Maceta barro #16</h5>
                            <p class="card-text">"Ideal para tus plantas favoritas, esta maceta de barro de tamaño #16 ofrece un ambiente saludable y natural para el crecimiento óptimo de tus plantas."</p>
                        </div>
                        <div class="card-footer">
                            <p class="card-text"><strong>Precio:</strong> $12.000</p>
                            <button class="btn btn-outline-success agregar-carrito" data-nombre="Maceta barro #16" data-precio="12000">Agregar al carrito</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-2 col-sm-12 mt-2">
                    <div class="card">
                        <img src="Multimedia/Maceta 14.jpg" class="card-img-top w-100 img-fluid" alt="Accesorio 9">
                        <div class="card-body">
                            <h5 class="card-title">Maceta barro #14</h5>
                            <p class="card-text">"Perfecta para plantas de tamaño mediano, esta maceta de barro #14 proporciona un entorno acogedor y saludable para el desarrollo óptimo de tus plantas en interiores o exteriores."</p>
                        </div>
                        <div class="card-footer">
                            <p class="card-text"><strong>Precio:</strong> $6.000</p>
                            <button class="btn btn-outline-success agregar-carrito" data-nombre="Maceta barro #14" data-precio="6000">Agregar al carrito</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-2 col-sm-12 mt-2">
                    <div class="card">
                        <img src="Multimedia/Maceta 12.jpg" class="card-img-top w-100 img-fluid" alt="Accesorio 10">
                        <div class="card-body">
                            <h5 class="card-title">Maceta barro #12</h5>
                            <p class="card-text">"Ideal para plantas más pequeñas, esta maceta de barro #12 es perfecta para cultivar tus plantas favoritas en espacios reducidos o para dar un toque de naturaleza a tu hogar con elegancia y estilo."</p>
                        </div>
                        <div class="card-footer">
                            <p class="card-text"><strong>Precio:</strong> $3.000</p>
                            <button class="btn btn-outline-success agregar-carrito" data-nombre="Maceta barro #12" data-precio="3000">Agregar al carrito</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-2 col-sm-12 mt-2">
                    <div class="card">
                        <img src="Multimedia/Clip.jpg" class="card-img-top w-100 img-fluid" alt="Accesorio 11">
                        <div class="card-body">
                            <h5 class="card-title">Clip gancho de amarre de plantas</h5>
                            <p class="card-text">"Conveniente y versátil, este clip gancho de amarre es la solución perfecta para mantener tus plantas seguras y bien sujetas. Su diseño resistente y fácil de usar te permite cuidar tus plantas de manera efectiva mientras mantienes un ambiente ordenado y organizado en tu jardín o espacio interior."</p>
                        </div>
                        <div class="card-footer">
                            <p class="card-text"><strong>Precio:</strong> $10.000</p>
                            <button class="btn btn-outline-success agregar-carrito" data-nombre="Clip gancho de amarre de plantas" data-precio="10000">Agregar al carrito</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-2 col-sm-12 mt-2">
                    <div class="card">
                        <img src="Multimedia/Higometro.jpg" class="card-img-top w-100 img-fluid" alt="Accesorio 11">
                        <div class="card-body">
                            <h5 class="card-title">Termómetro Higrómetro Digital</h5>
                            <p class="card-text">"Termómetro higrómetro digital que mide tanto la temperatura como la humedad del ambiente, ideal para mantener las condiciones óptimas para el crecimiento de tus plantas. Su pantalla LCD fácil de leer y su diseño compacto permiten un uso práctico y eficiente."</p>
                        </div>
                        <div class="card-footer">
                            <p class="card-text"><strong>Precio:</strong> $15.000</p>
                            <button class="btn btn-outline-success agregar-carrito" data-nombre="Termómetro Higrómetro Digital" data-precio="15000">Agregar al carrito</button>
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
