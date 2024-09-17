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

<!-- Sección de semillas -->
<section id="semillas">
    <div class="container">
        <h4>Nuestras Semillas</h4>
        <div class="row">
            <div class="col-md-6 col-lg-2 col-sm-12 mt-2">
                <div class="card">
                    <img src="Multimedia/Victoriana amazonica.jpg" class="card-img-top w-100 img-fluid" alt="Victoria Amazonica">
                    <div class="card-body">
                        <h5 class="card-title">Victoria Amazonica</h5>
                        <p class="card-text">Planta acuática de gran tamaño conocida por sus enormes hojas flotantes en forma de plato.</p>
                    </div>
                    <div class="card-footer">
                        <p class="card-text"><strong>Precio:</strong> $18.500</p>
                        <button class="btn btn-outline-success agregar-carrito" data-nombre="Victoria amazonica" data-precio="18500">Agregar al carrito</button>
                    </div>
                </div>
            </div>
        <div class="col-md-6 col-lg-2 col-sm-12 mt-2">
                <div class="card">
                    <img src="Multimedia/Flos de jamaica.jpg" class="card-img-top w-100 img-fluid" alt="Flor de Jamaica">
                    <div class="card-body">
                        <h5 class="card-title">Flor de Jamaica</h5>
                        <p class="card-text">Flor exótica y colorida, popular por su uso en infusiones refrescantes y como ornamental.</p>
                    </div>
                    <div class="card-footer">
                        <p class="card-text"><strong>Precio:</strong> $30.000</p>
                        <button class="btn btn-outline-success agregar-carrito" data-nombre="Flor de Jamaica" data-precio="30000">Agregar al carrito</button>
                    </div>
                </div>
            </div>
        <div class="col-md-6 col-lg-2 col-sm-12 mt-2">
                <div class="card">
                    <img src="Multimedia/Tulipan.jpg" class="card-img-top w-100 img-fluid" alt="Tulipan">
                    <div class="card-body">
                        <h5 class="card-title">Tulipan</h5>
                        <p class="card-text">Flor bulbosa de variados colores, asociada con la elegancia y la primavera.</p>
                    </div>
                    <div class="card-footer">
                        <p class="card-text"><strong>Precio:</strong> $32.500</p>
                        <button class="btn btn-outline-success agregar-carrito" data-nombre="Tulipan" data-precio="32500">Agregar al carrito</button>
                    </div>
                </div>
            </div>
        <div class="col-md-6 col-lg-2 col-sm-12 mt-2">
                <div class="card">
                    <img src="Multimedia/Ricino rojo.jpg" class="card-img-top w-100 img-fluid" alt="Ricino Rojo">
                    <div class="card-body">
                        <h5 class="card-title">Ricino Rojo</h5>
                        <p class="card-text">Planta ornamental de gran tamaño y follaje rojo intenso, apreciada por su impacto visual en jardines.</p>
                    </div>
                    <div class="card-footer">
                        <p class="card-text"><strong>Precio:</strong> $32.500</p>
                        <button class="btn btn-outline-success agregar-carrito" data-nombre="Ricino Rojo" data-precio="32500">Agregar al carrito</button>
                    </div>
                </div>
            </div>
        <div class="col-md-6 col-lg-2 col-sm-12 mt-2">
                <div class="card">
                    <img src="Multimedia/Snapdragon.jpg" class="card-img-top w-100 img-fluid" alt="Snapdragon">
                    <div class="card-body">
                        <h5 class="card-title">Snapdragon</h5>
                        <p class="card-text">Flor perenne que se asemeja a un dragón, conocida por sus colores vibrantes y su forma peculiar.</p>
                    </div>
                    <div class="card-footer">
                        <p class="card-text"><strong>Precio:</strong> $32.500</p>
                        <button class="btn btn-outline-success agregar-carrito" data-nombre="Snapdragon" data-precio="32500">Agregar al carrito</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-2 col-sm-12 mt-2">
                <div class="card">
                    <img src="Multimedia/Lavanda.jpg" class="card-img-top w-100 img-fluid" alt="Lavanda">
                    <div class="card-body">
                        <h5 class="card-title">Lavanda</h5>
                        <p class="card-text">Planta aromática con flores púrpuras, apreciada por su fragancia relajante y propiedades medicinales.</p>
                    </div>
                    <div class="card-footer">
                        <p class="card-text"><strong>Precio:</strong> $32.500</p>
                        <button class="btn btn-outline-success agregar-carrito" data-nombre="Lavanda" data-precio="32500">Agregar al carrito</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-2 col-sm-12 mt-2">
                <div class="card">
                    <img src="Multimedia/Girasol azul.jpg" class="card-img-top w-100 img-fluid" alt="Girasol Azul">
                    <div class="card-body">
                        <h5 class="card-title">Girasol Azul</h5>
                        <p class="card-text">Girasoles de color azul vibrante, una rareza en la naturaleza que añade un toque único a tu jardín.</p>
                    </div>
                    <div class="card-footer">
                        <p class="card-text"><strong>Precio:</strong> $35.000</p>
                        <button class="btn btn-outline-success agregar-carrito" data-nombre="Girasol Azul" data-precio="35000">Agregar al carrito</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-2 col-sm-12 mt-2">
                <div class="card">
                    <img src="Multimedia/Girasol amarillo.jpg" class="card-img-top w-100 img-fluid" alt="Girasol Amarillo">
                    <div class="card-body">
                        <h5 class="card-title">Girasol Amarillo</h5>
                        <p class="card-text">Girasoles de tonos dorados y amarillos brillantes, símbolos de alegría y vitalidad.</p>
                    </div>
                    <div class="card-footer">
                        <p class="card-text"><strong>Precio:</strong> $20.000</p>
                        <button class="btn btn-outline-success agregar-carrito" data-nombre="Girasol Amarillo" data-precio="20.000">Agregar al carrito</button>
                    </div>
                </div>
            </div>
        <div class="col-md-6 col-lg-2 col-sm-12 mt-2">
                <div class="card">
                    <img src="Multimedia/Cartuchos.jpg" class="card-img-top w-100 img-fluid" alt="Cartuchos">
                    <div class="card-body">
                        <h5 class="card-title">Cartuchos</h5>
                        <p class="card-text">Flores en forma de embudo con colores brillantes que añaden un toque de exotismo a tu jardín.</p>
                    </div>
                    <div class="card-footer">
                        <p class="card-text"><strong>Precio:</strong> $18.000</p>
                        <button class="btn btn-outline-success agregar-carrito" data-nombre="Cartuchos" data-precio="18000">Agregar al carrito</button>
                    </div>
                </div>
            </div>
        <div class="col-md-6 col-lg-2 col-sm-12 mt-2">
                <div class="card">
                    <img src="Multimedia/Rosa.jpg" class="card-img-top w-100 img-fluid" alt="Rosas">
                    <div class="card-body">
                        <h5 class="card-title">Rosas</h5>
                        <p class="card-text">Rosas clásicas en una variedad de colores, que representan el amor, la pasión y la elegancia.</p>
                    </div>
                    <div class="card-footer">
                        <p class="card-text"><strong>Precio:</strong> $22.000</p>
                        <button class="btn btn-outline-success agregar-carrito" data-nombre="Rosas" data-precio="22000">Agregar al carrito</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-2 col-sm-12 mt-2">
                <div class="card">
                    <img src="Multimedia/Passiflora.jpg" class="card-img-top w-100 img-fluid" alt="Rosas">
                    <div class="card-body">
                        <h5 class="card-title">Passiflora</h5>
                        <p class="card-text">Planta trepadora con flores exóticas, conocida por sus propiedades medicinales y ornamentalidad.</p>
                    </div>
                    <div class="card-footer">
                        <p class="card-text"><strong>Precio:</strong> $28.000</p>
                        <button class="btn btn-outline-success agregar-carrito" data-nombre="Passiflora" data-precio="28000">Agregar al carrito</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-2 col-sm-12 mt-2">
                <div class="card">
                    <img src="Multimedia/Amarilis.jpg" class="card-img-top w-100 img-fluid" alt="Rosas">
                    <div class="card-body">
                        <h5 class="card-title">Amarilis</h5>
                        <p class="card-text">Planta bulbosa con flores grandes y vistosas en una variedad de colores, ideal para jardinería y decoración.</p>
                    </div>
                    <div class="card-footer">
                        <p class="card-text"><strong>Precio:</strong> $40.000</p>
                        <button class="btn btn-outline-success agregar-carrito" data-nombre="Amarilis" data-precio="40000">Agregar al carrito</button>
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
