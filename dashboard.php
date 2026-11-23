<?php

session_start();

if (!isset($_SESSION['id'])) {

    header("Location: login.php");
    exit();

}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Dashboard</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="contenedor">

    <h1>Bienvenido</h1>

    <h3>
        <?php
        // htmlspecialchars convierte < > " ' & en texto,
        // así un nombre con código no se ejecuta (evita XSS)
        echo htmlspecialchars($_SESSION['nombre'], ENT_QUOTES, 'UTF-8');
        ?>
    </h3>

    <a href="logout.php">
        Cerrar Sesión
    </a>

</div>

</body>
</html>