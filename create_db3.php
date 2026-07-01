<?php
try {
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306', 'root', '123');
    $pdo->exec('CREATE DATABASE IF NOT EXISTS album_fisik');
    echo "Database created successfully\n";
} catch (Exception $e) {
    echo $e->getMessage() . "\n";
}
