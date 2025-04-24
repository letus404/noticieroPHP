<?php
require_once __DIR__ . '/../autor.php';
if (!isset($article)) {
    return;
}
$author = getRandomAuthor();
?>

<div class="card h-100">
    <img src="<?= $article['urlToImage'] ?? 'https://via.placeholder.com/600x400' ?>" class="card-img-top" alt="Imagen noticia">
    <div class="card-body d-flex flex-column justify-content-between">
        <h5 class="card-title"><?= htmlspecialchars($article['title']) ?></h5>
        <p class="card-text"><?= htmlspecialchars($article['description'] ?? 'Sin descripción') ?></p>
    </div>
    <div class="card-footer d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center">
            <img src="<?= $author['picture'] ?>" class="rounded-circle me-2" alt="Autor">
            <small class="text-muted"><?= $author['name'] ?></small>
        </div>
        <a href="<?= $article['url'] ?>" target="_blank" class="btn btn-sm btn-primary">Leer más</a>
    </div>
</div>