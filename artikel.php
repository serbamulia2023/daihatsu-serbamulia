<?php
require __DIR__ . '/config/config.php';
$pageTitle = 'Artikel Otomotif | Serba Mulia Auto';
$articles = db()->query("SELECT * FROM articles WHERE is_published=1 ORDER BY published_at DESC, id DESC")->fetchAll();
require __DIR__ . '/includes/header.php';
?>
<main class="page-content"><div class="container"><div class="eyebrow">Info & Tips</div><h1 class="page-title">Artikel Otomotif</h1><p class="page-lead">Tips, informasi kendaraan, perawatan, dan teknologi otomotif untuk Sahabat Daihatsu.</p>
<div class="articles"><?php foreach ($articles as $a): ?><article class="article"><?php if ($a['image_url']): ?><img class="article-img photo" src="<?= e($a['image_url']) ?>" alt="<?= e($a['title']) ?>" loading="lazy"><?php else: ?><div class="article-img article-placeholder">INFO OTOMOTIF</div><?php endif; ?><div class="article-body"><small><?= e(strtoupper($a['category'])) ?></small><h2><?= e($a['title']) ?></h2><p><?= e($a['summary']) ?></p><a class="text-link" href="<?= e(url('detail-artikel.php?slug='.urlencode($a['slug']))) ?>">Baca selengkapnya →</a></div></article><?php endforeach; ?><?php if (!$articles): ?><p>Belum ada artikel yang dipublikasikan.</p><?php endif; ?></div>
</div></main>
<?php require __DIR__ . '/includes/footer.php'; ?>
