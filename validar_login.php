<?php

session_start();

include("conexion.php");

if(
    !isset($_POST['correo']) ||
    !isset($_POST['password'])
){
    header("Location: login.php");
    exit();
}

$correo = trim($_POST['correo']);
$password = trim($_POST['password']);

if (
    empty($correo) ||
    empty($password)
) {

    $_SESSION['error'] =
    "Complete todos los campos";

    header("Location: login.php");
    exit();
}

if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {

    $_SESSION['error'] =
    "Correo inválido";

    header("Location: login.php");
    exit();
}

// Consulta preparada: el correo viaja aparte del SQL,
// así nunca se interpreta como parte de la consulta (evita inyección SQL)
$consulta =
mysqli_prepare(
    $conexion,
    "SELECT id, nombre, password FROM usuarios WHERE correo = ?"
);

mysqli_stmt_bind_param($consulta, "s", $correo);
mysqli_stmt_execute($consulta);

$resultado =
mysqli_stmt_get_result($consulta);

$usuario =
mysqli_fetch_assoc($resultado);

mysqli_stmt_close($consulta);

if (
    $usuario &&
    password_verify(
        $password,
        $usuario['password']
    )
) {

    // Nuevo id de sesión al iniciar sesión (evita fijación de sesión)
    session_regenerate_id(true);

    $_SESSION['id'] =
    $usuario['id'];

    $_SESSION['nombre'] =
    $usuario['nombre'];

    header("Location: dashboard.php");
    exit();
}

// El mismo mensaje para correo o contraseña incorrectos:
// así nadie puede averiguar qué correos están registrados
$_SESSION['error'] =
"Correo o contraseña incorrectos";

header("Location: login.php");
exit();

?>