<?php
session_start();
include '../includes/db.php';

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../pages/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $curso_id = intval($_POST['curso_id']);
    $usuario_id = $_SESSION['usuario_id'];

    $conn->begin_transaction();

    try {
        // Verificar si el usuario ya está inscrito en el curso
        $stmt_check = $conn->prepare("SELECT id FROM inscritos WHERE usuario_id = ? AND curso_id = ?");
        $stmt_check->bind_param("ii", $usuario_id, $curso_id);
        $stmt_check->execute();
        $stmt_check->store_result();

        if ($stmt_check->num_rows > 0) {
            $stmt_check->close();
            throw new Exception("Ya estás inscrito en este curso.");
        }
        $stmt_check->close();

        // Insertar la inscripción
        $stmt = $conn->prepare("INSERT INTO inscritos (usuario_id, curso_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $usuario_id, $curso_id);

        if (!$stmt->execute()) {
            throw new Exception("Error al registrar la inscripción. Inténtelo de nuevo.");
        }

        // Reducir los cupos del curso
        $stmt_update = $conn->prepare("UPDATE cursos SET cupos = cupos - 1 WHERE id = ? AND cupos > 0");
        $stmt_update->bind_param("i", $curso_id);

        if (!$stmt_update->execute() || $stmt_update->affected_rows === 0) {
            throw new Exception("Error: No hay cupos disponibles.");
        }

        $conn->commit();
        $_SESSION['success'] = "Inscripción exitosa.";
    } catch (Exception $e) {
        $conn->rollback();
        $_SESSION['error'] = $e->getMessage();
    }

    // Redirigir a la página de cursos disponibles
    header("Location: ../pages/cursos.php");
    exit;
}
?>

