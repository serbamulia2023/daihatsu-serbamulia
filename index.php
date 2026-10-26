<?php
require __DIR__ . '/config/config.php';
$pageTitle = 'Serba Mulia Auto Daihatsu | Dealer Resmi Daihatsu';
$description = 'Temukan mobil Daihatsu, promo, test drive, service, dan sparepart di cabang Serba Mulia Auto.';
try {
    $cars = db()->query("SELECT * FROM cars WHERE is_active=1 ORDER BY sort_order, name")->fetchAll();
    $branches = db()->query("SELECT * FROM branches WHERE is_active=1 ORDER BY sort_order, name")->fetchAll();
    $promos = db()->query("SELECT * FROM promos WHERE is_active=1 AND (end_date IS NULL OR end_date >= CURDATE()) ORDER BY created_at DESC LIMIT 3")->fetchAll();
    $articles = db()->query("SELECT * FROM articles WHERE is_published=1 ORDER BY published_at DESC, id DESC LIMIT 3")->fetchAll();
} catch (Throwable $ex) {
    $cars = $branches = $promos = $articles = [];
}
require __DIR__ . '/includes/header.php';
?>
<main>
<section class="hero">
    <div class="container hero-grid">

        <div class="hero-content">
            <div class="eyebrow">Authorized Dealer Daihatsu</div>

            <h1>
                <?= e(setting('hero_title', 'Temukan Daihatsu yang Pas Buat Kamu.')) ?>
            </h1>

            <p>
                <?= e(setting(
                    'hero_text',
                    'Serba Mulia Auto hadir untuk menemani kebutuhan mobilitas Anda, mulai dari pembelian mobil, test drive, service hingga sparepart di berbagai kota.'
                )) ?>
            </p>

            <div class="hero-actions">
                <a class="btn btn-red" href="#mobil">
                    Lihat Mobil Daihatsu
                </a>

                <a class="btn btn-outline" href="#cabang">
                    Cari Dealer Terdekat
                </a>
            </div>
        </div>

        <div class="hero-card">
            <div class="hero-card-content">
                <span class="hero-label">SERBA MULIA AUTO</span>

                <h2>Daihatsu di Kaltim & Papua</h2>

                <p>
                    Samarinda • Balikpapan • Paser • Jayapura • Sorong
                </p>
            </div>
        </div>

    </div>
</section>

<section id="mobil"><div class="container">
 <div class="section-head"><div><div class="eyebrow">Pilihan Mobil</div><h2>Mobil Daihatsu</h2></div><p>Pilih kendaraan sesuai kebutuhan keluarga, perjalanan harian, maupun usaha.</p></div>
 <div class="cars">
 <?php if ($cars): foreach ($cars as $car): ?>
  <article class="car">
   <?php if (!empty($car['image_url'])): ?><img class="car-img photo" src="<?= e($car['image_url']) ?>" alt="<?= e($car['name']) ?>" loading="lazy"><?php else: ?><div class="car-img"><?= e(strtoupper($car['name'])) ?></div><?php endif; ?>
   <h3><?= e($car['name']) ?></h3><small><?= e($car['category']) ?></small>
   <?php if ($car['description']): ?><p class="card-description"><?= e($car['description']) ?></p><?php endif; ?>
   <div class="car-actions"><a class="text-link" href="<?= e(url('detail-mobil.php?slug=' . urlencode((string)($car['slug'] ?: $car['id'])))) ?>">Detail kendaraan →</a><a class="text-link" href="<?= e($car['contact_url'] ?: '#cabang') ?>">Tanya mobil ini →</a></div>
  </article>
 <?php endforeach; else: ?><p>Data mobil belum tersedia. Jalankan setup.php untuk mengisi data awal.</p><?php endif; ?>
 </div>
</div></section>

<section id="cabang" class="branch-wrap"><div class="container">
 <div class="section-head"><div><div class="eyebrow">Dealer Serba Mulia Auto</div><h2>Temukan Cabang Daihatsu</h2></div><p>Pilih cabang untuk melihat informasi alamat, kontak, layanan, dan lokasi dealer.</p></div>
 <div class="branches">
 <?php foreach ($branches as $branch): ?>
  <article class="branch">
   <?php if (!empty($branch['image_url'])): ?>
    <img class="branch-photo photo" src="<?= e($branch['image_url']) ?>" alt="Foto dealer Daihatsu Serba Mulia Auto <?= e($branch['name']) ?>" loading="lazy">
   <?php else: ?>
    <div class="branch-photo-placeholder"><span>FOTO DEALER</span><small>Tambahkan foto melalui Admin → Kelola Cabang</small></div>
   <?php endif; ?>
   <div class="branch-content"><span class="tag"><?= e($branch['region']) ?></span><h3>Daihatsu <?= e($branch['name']) ?></h3><p><?= e($branch['address'] ?: 'Hubungi cabang untuk informasi alamat.') ?></p><a class="branch-link" href="<?= e(url('cabang.php?slug=' . urlencode($branch['slug']))) ?>">Lihat halaman cabang →</a></div>
  </article>
 <?php endforeach; ?>
 </div>
</div></section>

<section id="layanan"><div class="container">
 <div class="section-head"><div><div class="eyebrow">Layanan Daihatsu</div><h2>Lebih dari Sekadar Beli Mobil</h2></div><p>Satu jaringan untuk kebutuhan mobil Daihatsu Anda dari awal pembelian hingga perawatan.</p></div>
 <div class="services">
  <article class="service"><div class="icon">01</div><h3>Sales</h3><p>Konsultasi dan pilihan mobil Daihatsu sesuai kebutuhan Anda.</p></article>
  <article class="service"><div class="icon">02</div><h3>Test Drive</h3><p>Rasakan langsung mobil Daihatsu sebelum menentukan pilihan.</p></article>
  <article class="service"><div class="icon">03</div><h3>Service</h3><p>Perawatan berkala dan pemeriksaan kendaraan oleh tim bengkel.</p></article>
  <article class="service"><div class="icon">04</div><h3>Sparepart</h3><p>Dukungan kebutuhan suku cadang untuk menjaga performa kendaraan.</p></article>
 </div>
</div></section>

<section id="promo">
  <div class="container">
    <div class="cta">
      <div class="cta-grid">
        <div>
          <h2>Promo Daihatsu Terbaru</h2>
          <p>Cek program dan penawaran dari Serba Mulia Auto di cabang terdekat.</p>
        </div>
        <a class="btn btn-white" href="<?= e(url('promo.php')) ?>">Lihat Promo</a>
      </div>
    </div>

    <?php if ($promos): ?>
      <div class="promo-grid">
        <?php foreach ($promos as $promo): ?>
          <article class="promo-card">
            <?php if (!empty($promo['image_url'])): ?>
              <img class="promo-thumb photo" src="<?= e($promo['image_url']) ?>" alt="<?= e($promo['title']) ?>" loading="lazy">
            <?php endif; ?>
            <div class="promo-body">
              <span class="eyebrow">PROMO</span>
              <h3><?= e($promo['title']) ?></h3>
              <p>
    <?= e(mb_strimwidth($promo['summary'] ?? '', 0, 100, '...')) ?>
</p>
              <a class="text-link" href="<?= e(url('promo.php')) ?>">Detail promo →</a>
            </div>
          </article>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</section>

<section id="artikel"><div class="container">
 <div class="section-head"><div><div class="eyebrow">Info & Tips</div><h2>Artikel Otomotif</h2></div><p>Konten informatif seputar mobil, perawatan, teknologi, dan tips berkendara.</p></div>
 <div class="articles">
 <?php foreach ($articles as $article): ?><article class="article">
  <?php if ($article['image_url']): ?><img class="article-img photo" src="<?= e($article['image_url']) ?>" alt="<?= e($article['title']) ?>" loading="lazy"><?php else: ?><div class="article-img article-placeholder">INFO OTOMOTIF</div><?php endif; ?>
  <div class="article-body"><small><?= e(strtoupper($article['category'])) ?></small><h3><?= e($article['title']) ?></h3><p><?= e($article['summary']) ?></p><a class="text-link" href="<?= e(url('detail-artikel.php?slug=' . urlencode($article['slug']))) ?>">Baca artikel →</a></div>
 </article><?php endforeach; ?>
 <?php if (!$articles): ?><p>Artikel belum tersedia.</p><?php endif; ?>
 </div><p class="section-more"><a class="btn btn-outline" href="<?= e(url('artikel.php')) ?>">Lihat Semua Artikel</a></p>
</div></section>
<section id="tentang" class="about-section"><div class="container about-inner"><div class="eyebrow">Tentang Kami</div><h2>Serba Mulia Auto Daihatsu</h2><p>Menemani kebutuhan mobilitas Sahabat Daihatsu melalui jaringan cabang di Kalimantan Timur dan Papua. Silakan hubungi cabang untuk memastikan ketersediaan unit, promo, dan layanan.</p></div></section>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>
