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

$consulta =
"SELECT * FROM usuarios
WHERE correo='$correo'";

$resultado =
mysqli_query($conexion, $consulta);

if (mysqli_num_rows($resultado) > 0) {

    $_SESSION['error'] =
    "El correo ya está registrado";

    header("Location: register.php");
    exit();
}

$passwordHash =
password_hash($password, PASSWORD_DEFAULT);

$sql =
"INSERT INTO usuarios
(nombre, correo, password)
VALUES
('$nombre','$correo','$passwordHash')";

if (mysqli_query($conexion, $sql)) {

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