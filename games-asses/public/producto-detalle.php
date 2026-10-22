
<?php

$ruta = __DIR__ . "/../datos/datos.json";

$videojuegos = [];

if (file_exists($ruta)) {
    $contenido = file_get_contents($ruta);

    if ($contenido !== false) {
        $datos = json_decode($contenido, true);

        if (json_last_error() === JSON_ERROR_NONE && is_array($datos)) {
            $videojuegos = $datos;
        }
    }
}

$id = isset($_GET["id"]) ? intval($_GET["id"]) : 0;

$juego = null;

foreach ($videojuegos as $item) {
    if (isset($item["id"]) && $item["id"] == $id) {
        $juego = $item;
        break;
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameZone - Ficha del videojuego</title>
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>

<body>

    <header>
        <h1>🎮 Ficha del videojuego</h1>
        <p>Conoce todos los detalles</p>
    </header>

    <nav aria-label="Principal">
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="productos.php" aria-current="page">Catálogo</a></li>
            <li><a href="contacto.php">Contacto</a></li>
        </ul>
    </nav>

    <main>

        <?php if ($juego): ?>

            <article class="inicio">

                <h2>
                    <?= htmlspecialchars($juego["nombre"]) ?>
                </h2>

                <p>
                    <strong>Desarrolladora:</strong>
                    <?= htmlspecialchars($juego["desarrolladora"]) ?>
                </p>

                <p>
                    <strong>Género:</strong>
                    <?= htmlspecialchars($juego["genero"]) ?>
                </p>

                <p>
                    <strong>Plataforma:</strong>
                    <?= htmlspecialchars($juego["plataforma"]) ?>
                </p>

                <p class="precio">
                    Precio:
                    $<?= number_format($juego["precio"], 2) ?> MXN
                </p>

                <p>
                    <strong>Stock:</strong>
                    <?= htmlspecialchars((string)$juego["stock"]) ?>
                </p>

                <h3>Descripción</h3>

                <p class="descripcion">
                    <?= htmlspecialchars($juego["descripcion"]) ?>
                </p>

                <a class="boton" href="productos.php">
                    ← Regresar al catálogo
                </a>

            </article>

        <?php else: ?>

            <article class="inicio">

                <h2>Videojuego no encontrado</h2>

                <p>
                    No se encontró el videojuego solicitado.
                </p>

                <a class="boton" href="productos.php">
                    Regresar al catálogo
                </a>

            </article>

        <?php endif; ?>

    </main>

    <footer>
        <p>&copy; 2026 GameZone</p>
    </footer>

</body>
</html>
