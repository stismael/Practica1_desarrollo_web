<?php
session_start();
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validar campos obligatorios
    if (empty($email) || empty($password)) {
        $_SESSION['error'] = "Todos los campos son obligatorios.";
        header("Location: ../pages/login.html");
        exit;
    }

    // Consultar el usuario en la base de datos
    $stmt = $conn->prepare("SELECT id, nombre, password FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $user_name, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['usuario_id'] = $user_id;
            $_SESSION['usuario_nombre'] = $user_name;

            // Redirigir a cursos.php
            header("Location: ../pages/cursos.php");
            exit;
        } else {
            $_SESSION['error'] = "La contraseña es incorrecta.";
        }
    } else {
        $_SESSION['error'] = "El usuario no está registrado.";
    }

    $stmt->close();
    $conn->close();

    // Redirigir de vuelta al formulario
    header("Location: ../pages/login.php");
    exit;
}
?>
