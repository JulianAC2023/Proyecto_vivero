<?php
// login_process.php

// Incluir archivo de conexión
include 'index.php'; // Asegúrate de que este archivo establece la conexión $conexion

session_start(); // Iniciar sesión para manejar el estado de inicio de sesión

// Verificar que los datos del formulario están presentes
if (isset($_POST['nombre_usuario']) && isset($_POST['correo']) && isset($_POST['contrasena'])) {
    // Validar y sanitizar datos
    $NombreUsuario = filter_var($_POST['nombre_usuario'], FILTER_SANITIZE_STRING);
    $CorreoElectronico = filter_var($_POST['correo'], FILTER_SANITIZE_EMAIL);
    $Contrasena = $_POST['contrasena'];

    // Preparar consulta SQL para seleccionar el usuario
    $sql = "SELECT NombreUsuario, ContrasenaHash, Rol FROM perfilesusuario WHERE NombreUsuario = ? AND CorreoElectronico = ?";
    $stmt = $conexion->prepare($sql);

    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conexion->error);
    }

    $stmt->bind_param("ss", $NombreUsuario, $CorreoElectronico);
    $stmt->execute();
    $stmt->store_result();

    // Verificar si el usuario existe
    if ($stmt->num_rows === 1) {
        $stmt->bind_result($NombreUsuarioBD, $ContrasenaHashBD, $Rol);
        $stmt->fetch();

        // Verificar la contraseña
        if (password_verify($Contrasena, $ContrasenaHashBD)) {
            // Establecer las variables de sesión
            $_SESSION['nombre_usuario'] = $NombreUsuarioBD;
            $_SESSION['rol'] = $Rol;

            // Redirigir según el rol del usuario
            if ($Rol === 'admin') {
                header("Location: Main_admin.php");
                exit();
            } else if ($Rol === 'usuario') {
                header("Location: Main.php");
                exit();
            }
        } else {
            $error = "Contraseña incorrecta";
        }
    } else {
        $error = "Usuario no encontrado";
    }

    $stmt->close();
    $conexion->close();
} else {
    $error = "Faltan datos del formulario.";
}

// Mostrar mensaje de error si existe
if (isset($error)) {
    echo '<div class="alert alert-danger" role="alert">' . htmlspecialchars($error) . '</div>';
}
?>
