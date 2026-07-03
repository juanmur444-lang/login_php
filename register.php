<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Registro</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="contenedor">

    <h2>Crear Cuenta</h2>

    <p class="subtitulo">
        Complete los datos para registrarse
    </p>

    <?php

    if(isset($_SESSION['error'])){

        echo "<div class='mensaje-error'>"
        . $_SESSION['error']
        . "</div>";

        unset($_SESSION['error']);
    }

    ?>

    <div id="errores" class="mensaje-error" style="display:none;"></div>

    <form action="validar_register.php"
          method="POST"
          onsubmit="return validarRegistro()">

        <input
        type="text"
        id="nombre"
        name="nombre"
        placeholder="Nombre completo">

        <input
        type="email"
        id="correo"
        name="correo"
        placeholder="Correo electrónico">

        <input
        type="password"
        id="password"
        name="password"
        placeholder="Contraseña">

        <input
        type="password"
        id="confirmarPassword"
        name="confirmarPassword"
        placeholder="Confirmar contraseña">

        <div class="requisitos">

            <h4>Requisitos</h4>

            <p id="reqNombre">
                ❌ Nombre mínimo de 3 caracteres
            </p>

            <p id="reqLetras">
                ❌ Nombre solo letras
            </p>

            <p id="reqCorreo">
                ❌ Correo válido
            </p>

            <p id="reqPassword">
                ❌ Contraseña mínimo 6 caracteres
            </p>

            <p id="reqCoinciden">
                ❌ Las contraseñas deben coincidir
            </p>

        </div>

        <button type="submit">
            Registrarse
        </button>

    </form>

    <a href="login.php">
        Ya tengo una cuenta
    </a>

</div>

<script src="validaciones.js"></script>

</body>
</html>