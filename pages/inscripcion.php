<?php
// Incluir la conexión a la base de datos
include '../includes/db.php';

// Recoger el curso_id de la URL
$curso_id = isset($_GET['curso_id']) ? intval($_GET['curso_id']) : null;
$nombre_curso = null;

// Validar si se proporcionó un curso_id
if ($curso_id) {
    // Consulta para obtener el nombre del curso
    $stmt = $conn->prepare("SELECT nombre FROM cursos WHERE id = ?");
    $stmt->bind_param("i", $curso_id);
    $stmt->execute();
    $stmt->bind_result($nombre_curso);
    $stmt->fetch();
    $stmt->close();
}

// Validar si el curso no existe
if (!$nombre_curso) {
    die("Error: No se encontró el curso con el ID proporcionado.");
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscripción al Curso</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <header>
        <div>
            <h1>Formulario de Inscripción</h1>
            <nav>
                <ul>
                    <li><a href="cursos.php">Cursos Disponibles</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main>
        <section class="formulario-inscripcion">
            <h2>Inscríbete a <?php echo htmlspecialchars($nombre_curso) ?></h2>
            <form action="../operations/inscribir.php" method="POST" class="formulario">
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" required>
                </div>
                <div class="form-group">
                    <label for="email">Correo Electrónico:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="telefono">Teléfono:</label>
                    <input type="text" id="telefono" name="telefono" required>
                </div>
                <!-- Campo oculto para enviar el curso_id -->
                <input type="hidden" name="curso_id" value="<?php echo htmlspecialchars($curso_id); ?>">
                <button type="submit" class="btn-inscribirse">Inscribirse</button>
            </form>
        </section>
    </main>
    <footer>
        <p>© 2024 Inscripción a Cursos por Ismael Calle</p>
    </footer>
</body>
</html>
