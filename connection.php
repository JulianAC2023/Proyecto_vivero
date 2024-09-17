<?php
// Configuración de la base de datos
$servidor = "localhost"; // o la dirección IP del servidor
$usuario = "root"; // En MySQL, el usuario 'root' es sensible a mayúsculas
$contrasena = ""; // Si no hay contraseña, déjalo vacío
$baseDeDatos = "proyecto_vivero"; // Recomiendo usar guiones bajos en lugar de espacios

// Crear una conexión
$conexion = new mysqli($servidor, $usuario, $contrasena, $baseDeDatos);

/* Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
echo "Conexión exitosa";*/
?>
