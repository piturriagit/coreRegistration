<?php

declare(strict_types=1);

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    header('Allow: GET');
    exit('Method Not Allowed');
}

try {
    require_once __DIR__ . '/../config/database.php';

    $stmt = $pdo->query(
        'SELECT id, nombre, email
         FROM usuarios
         ORDER BY id ASC'
    );

    $users = $stmt->fetchAll();

} catch (RuntimeException $e) {
    header('Location: error.php?error=db_environment');
    exit;
} catch (PDOException $e) {
    header('Location: error.php?error=db_connection');
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de usuarios - lista de usuarios</title>
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

    <main class="users-container">

        <h1>Lista de usuarios</h1>
        <?php if (count($users) === 0): ?>

            <p class="empty-message">
                Ningún usuario registrado aún.
            </p>

        <?php else: ?>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= htmlspecialchars((string) $user['id'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td><?= htmlspecialchars($user['nombre'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td><?= htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        <?php endif; ?>

        <a class="button" href="home.html">
            Crear usuario
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