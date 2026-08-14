<?php

declare(strict_types=1);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    header('Allow: POST');
    exit('Method Not Allowed');
}

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

    $nombre = trim($_POST['nombre'] ?? '');
    $email = trim($_POST['email'] ?? '');

    if ($nombre === '' || $email === '') {
        http_response_code(400);
        exit('Invalid data');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        exit('Invalid email');
    }

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

} catch (PDOException $e) {
    http_response_code(500);
    echo 'Database connection failed: ' . $e->getMessage();
}