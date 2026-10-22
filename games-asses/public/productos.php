
<?php

$ruta = __DIR__ . "/../datos/datos.json";

$videojuegos = [];
$error = "";

if (file_exists($ruta)) {
    $contenido = file_get_contents($ruta);

    if ($contenido !== false) {
        $videojuegos = json_decode($contenido, true);

        if (json_last_error() !== JSON_ERROR_NONE || !is_array($videojuegos)) {
            $videojuegos = [];
            $error = "Error al leer los videojuegos.";
        }
    } else {
        $error = "No se pudo leer el archivo JSON.";
    }
} else {
    $error = "No se encontró el archivo datos.json.";
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameZone - Catálogo</title>
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>

<body>

    <header>
        <h1>🎮 GameZone</h1>
        <p>Catálogo de videojuegos</p>
    </header>

    <nav aria-label="Principal">
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="productos.php" aria-current="page">Catálogo</a></li>
            <li><a href="contacto.php">Contacto</a></li>
        </ul>
    </nav>

    <main>
        <h2>Nuestros videojuegos</h2>

        <?php if ($error !== ""): ?>
            <p class="error">
                <?= htmlspecialchars($error) ?>
            </p>
        <?php endif; ?>

        <section class="catalogo">

            <?php if (!empty($videojuegos)): ?>

                <?php foreach ($videojuegos as $juego): ?>

                    <article class="product-card">

                        <h3>
                            🎮 <?= htmlspecialchars($juego["nombre"]) ?>
                        </h3>

                        <p>
                            Género:
                            <?= htmlspecialchars($juego["genero"]) ?>
                        </p>

                        <p>
                            Plataforma:
                            <?= htmlspecialchars($juego["plataforma"]) ?>
                        </p>

                        <p class="precio">
                            $<?= number_format($juego["precio"], 2) ?> MXN
                        </p>

                        <p class="stock">
                            Stock:
                            <?= htmlspecialchars((string)$juego["stock"]) ?>
                        </p>

                        <a class="boton"
                           href="producto-detalle.php?id=<?= (int)$juego["id"] ?>">
                            Ver ficha
                        </a>

                    </article>

                <?php endforeach; ?>

            <?php else: ?>

                <article>
                    <h3>No hay videojuegos disponibles</h3>
                    <p>Revisa el archivo datos.json.</p>
                </article>

            <?php endif; ?>

        </section>
    </main>

    <footer>
        <p>&copy; 2026 GameZone</p>
    </footer>

</body>
</html>
