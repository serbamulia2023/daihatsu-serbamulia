<?php
require __DIR__ . '/config/config.php';
$slug = trim((string)($_GET['slug'] ?? ''));
$stmt = db()->prepare('SELECT * FROM articles WHERE slug = ? AND is_published = 1 LIMIT 1');
$stmt->execute([$slug]);
$article = $stmt->fetch();
if (!$article) { http_response_code(404); $pageTitle='Artikel tidak ditemukan'; require __DIR__.'/includes/header.php'; echo '<main class="container page-content"><h1>Artikel tidak ditemukan</h1><a href="'.e(url('artikel.php')).'">Kembali ke artikel</a></main>'; require __DIR__.'/includes/footer.php'; exit; }
$pageTitle = $article['title'] . ' | Serba Mulia Auto';
require __DIR__ . '/includes/header.php';
?>
<main class="page-content"><article class="container article-detail"><div class="breadcrumb"><a href="<?= e(url('artikel.php')) ?>">Artikel</a> / <?= e($article['category']) ?></div><div class="eyebrow"><?= e(strtoupper($article['category'])) ?></div><h1 class="page-title"><?= e($article['title']) ?></h1><p class="page-lead"><?= e($article['summary']) ?></p><?php if ($article['image_url']): ?><img class="detail-image" src="<?= e($article['image_url']) ?>" alt="<?= e($article['title']) ?>"><?php endif; ?><div class="article-content"><?= nl2br(e($article['body'])) ?></div><p><a class="text-link" href="<?= e(url('artikel.php')) ?>">← Kembali ke artikel</a></p></article></main>
<?php require __DIR__ . '/includes/footer.php'; ?>
