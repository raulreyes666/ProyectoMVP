<?php
session_start();

// Datos de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "trabajadores";

// Crear conexión
$conn = mysqli_connect($servername, $username, $password, $database);

// Verificar la conexión
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['user'];
    $contraseña = $_POST['passwd'];

    // Consulta SQL para verificar las credenciales
    $sql = "SELECT * FROM usuarios WHERE usuario='$usuario' AND contraseña='$contraseña'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        // Credenciales válidas, redirigir a la página principal
        $_SESSION['usuario'] = $usuario; // Guardar el usuario en la sesión
        header("Location: mainPage.html");
        exit();
    } else {
        // Credenciales incorrectas, redirigir de vuelta al formulario de login
        header("Location: index.html?error=invalid");
        exit();
    }
}
