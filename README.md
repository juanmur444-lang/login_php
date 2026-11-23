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

## Seguridad

Revisé el proyecto y corregí estos problemas:

| Problema | Riesgo | Corrección |
|---|---|---|
| El SQL se armaba pegando el correo y el nombre que escribe el usuario | Inyección SQL: alguien podía alterar la consulta | Consultas preparadas con `mysqli_prepare` y `?`, en el login y en el registro |
| El nombre se mostraba en el dashboard tal como estaba guardado | XSS: un nombre con código se ejecutaba en el navegador | `htmlspecialchars` antes de mostrarlo |
| La sesión mantenía el mismo id antes y después de iniciar sesión | Fijación de sesión | `session_regenerate_id(true)` al iniciar sesión |
| Mensajes distintos para "usuario no encontrado" y "contraseña incorrecta" | Permitía averiguar qué correos están registrados | Un solo mensaje: "Correo o contraseña incorrectos" |
| La regla "nombre solo letras" existía solo en JavaScript | Se podía saltar enviando la petición directo | La misma validación también en PHP |

Lo probé con registro y login normales, correo repetido, un intento de inyección SQL en el correo, un nombre con `<script>` y el acceso al dashboard sin sesión.

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
- Encontrar y corregir vulnerabilidades comunes: inyección SQL, XSS y fijación de sesión.

## Mejoras pendientes

- Limitar los intentos de inicio de sesión fallidos.
- Agregar un token CSRF a los formularios.
- Leer los datos de conexión desde variables de entorno en lugar de escribirlos en `conexion.php`.

## Autor

Juan Andrés Mur Bermúdez · [github.com/juanmur444-lang](https://github.com/juanmur444-lang)
