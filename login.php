<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="contenedor">

    <h2>Iniciar Sesión</h2>

    <p class="subtitulo">
        Ingrese sus credenciales
    </p>

    <?php

    if(isset($_SESSION['mensaje'])){

        echo "<div class='mensaje-exito'>"
        . $_SESSION['mensaje']
        . "</div>";

        unset($_SESSION['mensaje']);
    }

    if(isset($_SESSION['error'])){

        echo "<div class='mensaje-error'>"
        . $_SESSION['error']
        . "</div>";

        unset($_SESSION['error']);
    }

    ?>

    <div id="errores" class="mensaje-error" style="display:none;"></div>

    <form action="validar_login.php"
          method="POST"
          onsubmit="return validarLogin()">

        <input
        type="email"
        id="correo"
        name="correo"
        placeholder="Correo">

        <input
        type="password"
        id="password"
        name="password"
        placeholder="Contraseña">

        <button type="submit">
            Ingresar
        </button>

    </form>

    <a href="register.php">
        Crear Cuenta
    </a>

</div>

<script src="validaciones.js"></script>

</body>
</html>