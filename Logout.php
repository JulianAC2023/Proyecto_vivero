<?php
session_start();
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desconectado</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
        }
        .message-box {
            padding: 20px;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .message-box h1 {
            color: #e74c3c;
            margin: 0;
        }
        .message-box p {
            color: #333;
        }
    </style>
    <script>
        // Redirigir después de 3 segundos
        setTimeout(function() {
            window.location.href = 'Index.html';
        }, 3000);
    </script>
</head>
<body>
    <div class="message-box">
        <h1>¡Te has desconectado!</h1>
        <p>Serás redirigido a la página de inicio en 3 segundos...</p>
    </div>
</body>
</html>
