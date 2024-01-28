<?php

$servername = "localhost";
$database = "usuarios";

$conn = new mysqli($servername, 'root', '', $database);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['registro'])) {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    $sql = "INSERT INTO usuarios (usuario, contrasena) VALUES ('$usuario', '$contrasena')";

    
    if ($conn->query($sql) === TRUE) {
        echo "Usuario registrado correctamente";
    } else {
        echo "Error al registrar el usuario: " . $conn->error;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    // Verificar credenciales en la base de datos
    $sql = "SELECT * FROM usuarios WHERE usuario='$usuario' AND contrasena='$contrasena'";
    
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "Autenticación satisfactoria";
    } else {
        http_response_code(401); // Establecer código de respuesta HTTP 401 Unauthorized
        echo "Error en la autenticación";
    }
}

$conn->close();
?>