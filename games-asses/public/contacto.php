
<?php

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nombre = trim($_POST["nombre"] ?? "");
    $correo = trim($_POST["correo"] ?? "");
    $asunto = trim($_POST["asunto"] ?? "");
    $mensajeUsuario = trim($_POST["mensaje"] ?? "");

    if (
        $nombre !== "" &&
        filter_var($correo, FILTER_VALIDATE_EMAIL) &&
        $asunto !== "" &&
        $mensajeUsuario !== ""
    ) {
        $mensaje = "Gracias, " . htmlspecialchars($nombre) .
                   ". Tu mensaje fue recibido en el formulario.";
    } else {
        $mensaje = "Por favor, completa correctamente todos los campos.";
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameZone - Contacto</title>
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>

<body>

    <header>
        <h1>📩 Contacto GameZone</h1>
        <p>Estamos para ayudarte</p>
    </header>

    <nav aria-label="Principal">
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="productos.php">Catálogo</a></li>
            <li><a href="contacto.php" aria-current="page">Contacto</a></li>
        </ul>
    </nav>

    <main>

        <section>

            <h2>Contáctanos</h2>

            <p>
                ¿Tienes alguna pregunta sobre nuestros videojuegos?
                Envíanos un mensaje.
            </p>

            <?php if ($mensaje !== ""): ?>
                <div class="mensaje">
                    <?= $mensaje ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="contacto.php">

                <label for="nombre">Nombre</label>
                <input
                    type="text"
                    id="nombre"
                    name="nombre"
                    required
                >

                <label for="correo">Correo electrónico</label>
                <input
                    type="email"
                    id="correo"
                    name="correo"
                    required
                >

                <label for="asunto">Asunto</label>
                <input
                    type="text"
                    id="asunto"
                    name="asunto"
                    required
                >

                <label for="mensaje">Mensaje</label>
                <textarea
                    id="mensaje"
                    name="mensaje"
                    required
                ></textarea>

                <button type="submit">
                    Enviar mensaje
                </button>

            </form>

        </section>

    </main>

    <footer>
        <p>&copy; 2026 GameZone</p>
    </footer>

</body>
</html>
