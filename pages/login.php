<?php
session_start();
$error_message = isset($_SESSION['error']) ? $_SESSION['error'] : '';
unset($_SESSION['error']); // Limpiar el mensaje después de mostrarlo
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Iniciar Sesión</h1>
            <nav>
                <ul>
                    <li><a href="index.html">Inicio</a></li>
                    <li><a href="registro.html">Registrarse</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main>
        <section class="formulario-inscripcion">
            <h2>Accede a tu cuenta</h2>
            <form action="../operations/login.php" method="POST">
                <div class="form-group">
                    <label for="email">Correo Electrónico:</label>
                    <input type="email" id="email" name="email" placeholder="Ingresa tu correo" required>
                </div>
                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña" required>
                    <!-- Mostrar mensaje de error si existe -->
                    <?php if (!empty($error_message)): ?>
                        <p style="color: red; font-size: 0.9rem;"><?php echo $error_message; ?></p>
                    <?php endif; ?>
                </div>
                <br/>
                <button type="submit" class="btn-login">Iniciar Sesión</button>
            </form>
            <br/>
            <p><strong>¿No tienes cuenta? </strong><a href="registro.html">Regístrate aquí</a></p>
        </section>
    </main>
    <footer>
        <p>© 2024 Inscripción a Cursos por Ismael Calle</p>
    </footer>
</body>
</html>

