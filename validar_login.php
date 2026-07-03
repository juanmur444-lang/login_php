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

$sql =
"SELECT * FROM usuarios
WHERE correo='$correo'";

$resultado =
mysqli_query($conexion, $sql);

if (mysqli_num_rows($resultado) == 1) {

    $usuario =
    mysqli_fetch_assoc($resultado);

    if (
        password_verify(
            $password,
            $usuario['password']
        )
    ) {

        $_SESSION['id'] =
        $usuario['id'];

        $_SESSION['nombre'] =
        $usuario['nombre'];

        header("Location: dashboard.php");
        exit();

    } else {

        $_SESSION['error'] =
        "Contraseña incorrecta";

        header("Location: login.php");
        exit();
    }

} else {

    $_SESSION['error'] =
    "Usuario no encontrado";

    header("Location: login.php");
    exit();
}

?>