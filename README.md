# Sistema de inicio de sesión en PHP

Sistema de registro e inicio de sesión hecho con PHP y MySQL. El usuario se registra, inicia sesión con su correo y contraseña, entra a una página privada y puede cerrar sesión.

Práctica académica del Tecnólogo en Análisis y Desarrollo de Software (ADSO), SENA.

## Funcionalidades

- Registro de usuarios con nombre, correo y contraseña.
- Las contraseñas se guardan cifradas con `password_hash` y se comprueban con `password_verify`.
- El correo es único: no se puede registrar dos veces.
- Validaciones en el navegador (JavaScript) que muestran en vivo qué requisitos se cumplen.
- Validaciones en el servidor (PHP): campos obligatorios, correo válido, nombre de mínimo 3 caracteres, contraseña de mínimo 6 y confirmación de contraseña.
- Mensajes de error y de éxito guardados en la sesión.
- Página privada (`dashboard.php`) que solo se ve con la sesión iniciada.
- Cierre de sesión.

## Tecnologías

- PHP
- MySQL / MariaDB (con XAMPP)
- HTML, CSS y JavaScript

## Estructura

| Archivo | Para qué sirve |
|---|---|
| `register.php` | Formulario de registro |
| `validar_register.php` | Valida los datos y crea el usuario |
| `login.php` | Formulario de inicio de sesión |
| `validar_login.php` | Comprueba el correo y la contraseña e inicia la sesión |
| `dashboard.php` | Página privada |
| `logout.php` | Cierra la sesión |
| `conexion.php` | Conexión a la base de datos |
| `validaciones.js` | Validaciones del lado del navegador |
| `database.sql.sql` | Script para crear la base de datos `sistema_login` |

## Cómo ejecutarlo

1. Instala [XAMPP](https://www.apachefriends.org/) e inicia **Apache** y **MySQL**.
2. Copia la carpeta del proyecto dentro de `C:\xampp\htdocs\`.
3. Abre `http://localhost/phpmyadmin`, crea la base de datos `sistema_login` e importa el archivo `database.sql.sql`.
4. Abre `http://localhost/login_php/register.php` y crea tu usuario.

Si tu MySQL tiene otro usuario o contraseña, cámbialos en `conexion.php`.

## Qué aprendí

- Manejar sesiones en PHP (`session_start`, `$_SESSION`, `session_destroy`).
- Guardar contraseñas de forma segura con hash.
- Validar datos en el navegador y otra vez en el servidor, porque la validación del navegador se puede saltar.
- Proteger páginas privadas revisando la sesión.

## Mejoras pendientes

- Usar consultas preparadas (`mysqli_prepare`) en lugar de armar el SQL con el texto del usuario, para evitar inyección SQL.
- Escapar el nombre con `htmlspecialchars` al mostrarlo en el dashboard, para evitar XSS.
- Regenerar el id de sesión al iniciar sesión (`session_regenerate_id`).
- Limitar los intentos de inicio de sesión fallidos.

## Autor

Juan Andrés Mur Bermúdez · [github.com/juanmur444-lang](https://github.com/juanmur444-lang)
