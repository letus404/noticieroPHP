<?php
require_once 'news.php';

// Obtener la página desde la URL, asegurándonos de que sea válida
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;

// Obtener las noticias para la página actual
$news = getNews($page);
?>

<?php include 'templates/header.php'; ?>

<div class="container mt-4">
    <h1 class="mb-4">Noticias del Día</h1>

    <!-- Mostrar noticias -->
    <div class="row">
        <?php if ($news): ?>
            <?php foreach ($news as $article): ?>
                <div class="col-md-6 mb-4">
                    <?php include 'templates/post_card.php'; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No se pudieron obtener noticias en este momento.</p>
        <?php endif; ?>
    </div>

    <!-- Paginación -->
    <nav aria-label="Paginación de noticias">
        <ul class="pagination justify-content-center">
            <!-- Botón de "Anterior" -->
            <?php if ($page > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?= $page - 1 ?>">Anterior</a>
                </li>
            <?php else: ?>
                <li class="page-item disabled">
                    <span class="page-link">Anterior</span>
                </li>
            <?php endif; ?>

            <!-- Mostrar la página actual -->
            <li class="page-item active">
                <span class="page-link"><?= $page ?></span>
            </li>

            <!-- Botón de "Siguiente" -->
            <?php if (count($news) === 10): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?= $page + 1 ?>">Siguiente</a>
                </li>
            <?php else: ?>
                <li class="page-item disabled">
                    <span class="page-link">Siguiente</span>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</div>

<?php include 'templates/footer.php'; ?>