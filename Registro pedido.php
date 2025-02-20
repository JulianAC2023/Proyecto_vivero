<?php
session_start();
if (!isset($_SESSION['nombre_usuario'])) {
    header("Location: Login.html");
    exit();
}

include 'connection.php';  // Conexión a la base de datos (ya está incluida)

// Verificar si el carrito existe en la sesión
if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
    $carrito = $_SESSION['carrito'];
} else {
    // Si el carrito está vacío o no existe, redirigir al usuario
    header("Location: Productos clientes.php");
    exit();
}

// Obtener el ID del usuario logueado
$usuarioID = $_SESSION['UsuarioID']; // Asumiendo que el usuario tiene un ID en la sesión

// Inicializar el total del pedido
$totalPedido = 0;

// Preparar la consulta SQL para insertar en la base de datos
$sql = "INSERT INTO pedidos (UsuarioID, ProductoID, Cantidad, FechaPedido, Total) VALUES (?, ?, ?, CURRENT_TIMESTAMP, ?)";

// Preparar la consulta
$stmt = $conn->prepare($sql);

// Verificar si la preparación fue exitosa
if ($stmt === false) {
    die("Error en la preparación de la consulta: " . $conn->error);
}

// Recorrer el carrito y procesar cada producto
foreach ($carrito as $producto) {
    $productoID = $producto['id'];
    $cantidad = $producto['cantidad'];
    $precio = $producto['precio'];

    // Calcular el total para este producto
    $totalProducto = $precio * $cantidad;

    // Insertar en la base de datos (tabla de pedidos)
    $stmt->bind_param("iiid", $usuarioID, $productoID, $cantidad, $totalProducto);

    if ($stmt->execute()) {
        // Si la inserción fue exitosa, continuar con la siguiente
        // echo "Nuevo pedido registrado correctamente<br>";
    } else {
        // Si hay un error en la inser
