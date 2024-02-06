<?php
// Conexión a la base de datos
$host = "localhost";
$dbname = "AFC_CHILE";
$username = "postgres";
$password = "Francis12Munoz";

$db = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
if (!$db) {
    echo "Error: No se pudo conectar a PostgreSQL.";
    exit;
}

//return $db;
