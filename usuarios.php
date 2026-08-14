<?php

declare(strict_types=1);

$host = '127.0.0.1';
$dbname = 'usuarios_db';
$username = 'admin';
$password = 'admin@123';

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );

    $stmt = $pdo->query(
        'SELECT id, nombre, email
         FROM usuarios
         ORDER BY id ASC'
    );

    $users = $stmt->fetchAll();

} catch (PDOException $e) {
    http_response_code(500);
    echo 'Database connection failed: ' . $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de usuarios</title>
    <meta name="description" content="Deberás crear un sistema simple de registro de usuarios. Los usuarios podrán ingresar su nombre y correo electrónico a través de un formulario HTML, y estos datos se almacenarán en una base de datos MySQL utilizando PHP">
    <meta name="keywords" content="registro, mvc, php, html, sql, corenetworks, caso práctico, base de datos">
    <meta name="author" content="Patricia">
    <link rel="stylesheet" href="style.css">
    
</head>

<body>

    <header>
        <h1>Registro de Usuarios en una Base de Datos</h1>
    </header>

    <main class="users-container">

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

</body>
</html>