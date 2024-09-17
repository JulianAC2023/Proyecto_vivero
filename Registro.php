<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .alert-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Altura de la ventana del navegador */
        }
    </style>
</head>
<body>

<?php
// Incluir archivo de conexión
include 'index.php';

// Verificar que los datos del formulario están presentes
if (isset($_POST['nombre_usuario']) && isset($_POST['nombre_completo']) && isset($_POST['correo']) && isset($_POST['contrasena']) && isset($_POST['telefono']) && isset($_POST['direccion'])) {
    // Validar y sanitizar datos
    $NombreUsuario = filter_var($_POST['nombre_usuario'], FILTER_SANITIZE_STRING);
    $NombreCompleto = filter_var($_POST['nombre_completo'], FILTER_SANITIZE_STRING);
    $CorreoElectronico = filter_var($_POST['correo'], FILTER_SANITIZE_EMAIL);
    $ContrasenaHash = password_hash($_POST['contrasena'], PASSWORD_BCRYPT); // Encriptar la contraseña
    $Telefono = filter_var($_POST['telefono'], FILTER_SANITIZE_STRING);
    $Direccion = filter_var($_POST['direccion'], FILTER_SANITIZE_STRING);

    // Preparar consulta SQL para insertar datos
    $sql = "INSERT INTO perfilesusuario (NombreUsuario, NombreCompleto, CorreoElectronico, ContrasenaHash, FechaRegistro, FechaUltimoAcceso, Rol, Activo, Direccion)
            VALUES (?, ?, ?, ?, NOW(), NULL, 'usuario', '1', ?)";

    $stmt = $conexion->prepare($sql);
    if ($stmt === false) {
        die('<div class="alert-container"><div class="alert alert-danger" role="alert">Error en la preparación de la consulta: ' . $conexion->error . '</div></div>');
    }

    // El tipo de parámetros para bind_param debería ser "sssss" para 5 parámetros de tipo string
    $stmt->bind_param("sssss", $NombreUsuario, $NombreCompleto, $CorreoElectronico, $ContrasenaHash, $Direccion);

    if ($stmt->execute()) {
        echo '<div class="alert-container"><div class="alert alert-success" role="alert">Registro creado exitosamente</div></div>';
    } else {
        echo '<div class="alert-container"><div class="alert alert-danger" role="alert">Error: ' . $stmt->error . '</div></div>';
    }

    // Cerrar conexión
    $stmt->close();
    $conexion->close();
} else {
    echo '<div class="alert-container"><div class="alert alert-warning" role="alert">Faltan datos del formulario.</div></div>';
}
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
