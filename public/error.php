<?php

declare(strict_types=1);

$error = $_GET['error'] ?? 'unknown';
$email = $_GET['email'] ?? '';

$errorTitles = [
    'db_environment' => 'Error de configuración de la base de datos',
    'db_connection'  => 'Error de conexión a la base de datos',
    'db_query'       => 'Error en la consulta a la base de datos',
    'email_exists'   => 'Email en uso',
];

$errorMessages = [
    'db_environment' => 'Las variables de entorno de la base de datos no están configuradas.',
    'db_connection'  => 'No se pudo conectar a la base de datos.',
    'db_query'       => 'Ocurrió un error al ejecutar la consulta a la base de datos.',
    'email_exists'   => 'Ya existe un usuario con este correo electrónico' . ($email ? ': <br>&emsp;<em>' . $email . '</em>' : '.') . '<br>Por favor, elige otro correo electrónico.',
];

$title = $errorTitles[$error] ?? 'Error';
$message = $errorMessages[$error] ?? 'Ocurrió un error desconocido.';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de usuarios - error</title>
    <meta name="description" content="Deberás crear un sistema simple de registro de usuarios. Los usuarios podrán ingresar su nombre y correo electrónico a través de un formulario HTML, y estos datos se almacenarán en una base de datos MySQL utilizando PHP">
    <meta name="keywords" content="registro, mvc, php, html, sql, corenetworks, caso práctico, base de datos">
    <meta name="author" content="Patricia">
    <link rel="icon" href="assets/images/favicon32.png" type="image/png" sizes="32x32">
    <link rel="icon" href="assets/images/favicon48.png" type="image/png" sizes="48x48">
    <link rel="stylesheet" href="assets/css/style.css">
    
</head>
<body>
    <header>
        <a href="home.html" aria-label="Go to homepage">
            <img src="assets/images/logo.png" alt="" class="site-logo">
        </a>
        <span class="site-name">Registro de Usuarios en una Base de Datos</span>
    </header>

    <main>
        <h1>
            <?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?>
        </h1>

        <p>
            <?= $message ?>
        </p>

        <a class="button" href="usuarios.php">
            Lista de usuarios
        </a>
        
        <a class="button" href="home.html">
            Crear otro usuario
        </a>
    </main>
    <footer>
        <p>
            &copy; <script>let year = document.write(new Date().getFullYear());year?year:2026;</script> Registro de Usuarios
        </p>

        <nav aria-label="Footer navigation">
            <a href="https://github.com/piturriagit/coreRegistration">Github</a>
            <a href="mailto:iturriaga.patricia@icloud.com?subject=%5BcoreRegistration%5D%20">Contact</a>
        </nav>
    </footer>
</body>
</html>