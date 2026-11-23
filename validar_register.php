<?php

session_start();

include("conexion.php");

if(
    !isset($_POST['nombre']) ||
    !isset($_POST['correo']) ||
    !isset($_POST['password']) ||
    !isset($_POST['confirmarPassword'])
){
    header("Location: register.php");
    exit();
}

$nombre = trim($_POST['nombre']);
$correo = trim($_POST['correo']);
$password = trim($_POST['password']);
$confirmarPassword = trim($_POST['confirmarPassword']);

if (
    empty($nombre) ||
    empty($correo) ||
    empty($password) ||
    empty($confirmarPassword)
) {

    $_SESSION['error'] =
    "Todos los campos son obligatorios";

    header("Location: register.php");
    exit();
}

if (strlen($nombre) < 3) {

    $_SESSION['error'] =
    "El nombre debe tener mínimo 3 caracteres";

    header("Location: register.php");
    exit();
}

// La misma regla que en validaciones.js, pero en el servidor,
// porque la validación del navegador se puede saltar
if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/u", $nombre)) {

    $_SESSION['error'] =
    "El nombre solo puede contener letras";

    header("Location: register.php");
    exit();
}

if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {

    $_SESSION['error'] =
    "Correo inválido";

    header("Location: register.php");
    exit();
}

if (strlen($password) < 6) {

    $_SESSION['error'] =
    "La contraseña debe tener mínimo 6 caracteres";

    header("Location: register.php");
    exit();
}

if ($password != $confirmarPassword) {

    $_SESSION['error'] =
    "Las contraseñas no coinciden";

    header("Location: register.php");
    exit();
}

// Consultas preparadas: los datos del usuario viajan aparte del SQL
// (evita inyección SQL)
$consulta =
mysqli_prepare(
    $conexion,
    "SELECT id FROM usuarios WHERE correo = ?"
);

mysqli_stmt_bind_param($consulta, "s", $correo);
mysqli_stmt_execute($consulta);
mysqli_stmt_store_result($consulta);

$yaExiste =
mysqli_stmt_num_rows($consulta) > 0;

mysqli_stmt_close($consulta);

if ($yaExiste) {

    $_SESSION['error'] =
    "El correo ya está registrado";

    header("Location: register.php");
    exit();
}

$passwordHash =
password_hash($password, PASSWORD_DEFAULT);

$insertar =
mysqli_prepare(
    $conexion,
    "INSERT INTO usuarios (nombre, correo, password) VALUES (?, ?, ?)"
);

mysqli_stmt_bind_param(
    $insertar,
    "sss",
    $nombre,
    $correo,
    $passwordHash
);

if (mysqli_stmt_execute($insertar)) {

    $_SESSION['mensaje'] =
    "Registro exitoso. Ahora puede iniciar sesión.";

    header("Location: login.php");
    exit();

} else {

    $_SESSION['error'] =
    "Error al registrar usuario";

    header("Location: register.php");
    exit();
}

?>