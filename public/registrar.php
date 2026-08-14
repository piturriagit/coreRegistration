<?php

declare(strict_types=1);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    header('Allow: POST');
    exit('Method Not Allowed');
}

try {
    require_once __DIR__ . '/../config/database.php';

    $nombre = trim($_POST['nombre'] ?? '');
    $email = trim($_POST['email'] ?? '');

    if ($nombre === '' || $email === '') {
        header('Location: error.php?error=db_query');
        exit;
    }

    /* Check if user with the same email already exists in the database */

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('Location: error.php?error=db_query');
        exit;
    }

        $stmt = $pdo->prepare(
        'SELECT id
         FROM usuarios
         WHERE email = :email
         LIMIT 1'
    );

    $stmt->execute([
        'email' => $email,
    ]);

    if ($stmt->fetch()) {
        header('Location: error.php?error=email_exists&email=' . urlencode($email));
        exit;
    }

    /* Insert the new user into the database */

    $stmt = $pdo->prepare(
        'INSERT INTO usuarios (nombre, email)
         VALUES (:nombre, :email)'
    );

    $stmt->execute([
        'nombre' => $nombre,
        'email' => $email,
    ]);

    header('Location: success.html');
    exit;

} catch (RuntimeException $e) {
    header('Location: error.php?error=db_environment');
    exit;
} catch (PDOException $e) {
    header('Location: error.php?error=db_connection');
    exit;
}