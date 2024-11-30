<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

// Conexión a la base de datos
include '../includes/db.php';

// Mensajes de éxito o error
$success_message = isset($_SESSION['success']) ? $_SESSION['success'] : '';
$error_message = isset($_SESSION['error']) ? $_SESSION['error'] : '';
unset($_SESSION['success'], $_SESSION['error']); // Limpiar mensajes después de mostrarlos
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cursos Disponibles</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Open+Sans:wght@300;400&display=swap" rel="stylesheet">
</head>
<body>

<header>
    <div class="container">
        <h1>Cursos Disponibles</h1>
        <nav>
            <ul>
                <li><a href="index.html">Inicio</a></li>
                <li><a href="../operations/logout.php">Cerrar Sesión</a></li>
            </ul>
        </nav>
    </div>
</header>

<main>
    <div class="container">
        <!-- Mostrar mensajes de éxito o error -->
        <?php if (!empty($success_message)): ?>
            <p style="color: green; font-weight: bold;"><?php echo $success_message; ?></p>
        <?php endif; ?>

        <?php if (!empty($error_message)): ?>
            <p style="color: red; font-weight: bold;"><?php echo $error_message; ?></p>
        <?php endif; ?>

        <h2>Selecciona un curso para inscribirte</h2>
        <div class="cursos-lista">
            <ul>
                <!-- Incluir los cursos disponibles -->
                <?php include '../operations/obtener_cursos.php'; ?>
            </ul>
        </div>
    </div>
</main>
<footer>
    <p>© 2024 Inscripción a Cursos por Ismael Calle</p>
</footer>
</body>
</html>