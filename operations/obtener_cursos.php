<?php
// Incluir la conexión a la base de datos
include '../includes/db.php';

// Consulta para obtener los cursos con cupos disponibles
$sql = "SELECT * FROM cursos WHERE cupos > 0";
$result = $conn->query($sql);

// Verificar si hay resultados
if ($result->num_rows > 0) {
    // Si hay cursos, los mostramos
    while ($row = $result->fetch_assoc()) {
        echo "<li>
                <h3>{$row['nombre']}</h3>
                <p>{$row['descripcion']}</p>
                <p>Fechas: {$row['fecha_inicio']} a {$row['fecha_fin']}</p>
                <p>Cupos disponibles: {$row['cupos']}</p>
                <a href='inscripcion.php?curso_id={$row['id']}'>Inscribirse</a>
            </li>";
    }
} else {
    echo "<p>No hay cursos disponibles en este momento.</p>";
}

// Cerrar la conexión
$conn->close();
?>

