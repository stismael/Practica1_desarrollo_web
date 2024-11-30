<?php
$host = 'localhost';
$user = 'root';
$password = 'stismael03';
$dbname = 'insc_cursos';

// Crear conexión
$conn = new mysqli($host, $user, $password, $dbname);

// Comprobar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
