<?php
require dirname(__DIR__) . '/config/config.php';
require_admin();
$counts = [];
foreach (['cars'=>'Mobil','branches'=>'Cabang','promos'=>'Promo','articles'=>'Artikel'] as $table=>$label) {
    $counts[$label] = (int)db()->query("SELECT COUNT(*) FROM `$table`")->fetchColumn();
}
$pageTitle = 'Dashboard Admin | ' . SITE_NAME;
require dirname(__DIR__) . '/includes/header.php';
?>
<main class="page-content"><div class="container"><div class="admin-top"><div><div class="eyebrow">Panel Pengelolaan</div><h1 class="page-title">Dashboard Admin</h1><p>Halo, <?= e((string)($_SESSION['admin_name'] ?? 'Admin')) ?>. Kelola konten website dari sini.</p></div><a class="btn btn-outline" href="<?= e(url('admin/logout.php')) ?>">Keluar</a></div>
<div class="admin-stats"><?php foreach ($counts as $label=>$count): ?><div class="stat-card"><span><?= e($label) ?></span><strong><?= $count ?></strong></div><?php endforeach; ?></div>
<div class="admin-grid">
<a class="admin-tile" href="<?= e(url('admin/manage.php?type=cars')) ?>"><strong>Kelola Mobil</strong><span>Tambah, edit, dan tampilkan mobil.</span></a>
<a class="admin-tile" href="<?= e(url('admin/variants.php')) ?>"><strong>Kelola Varian & Detail Mobil</strong><span>Atur tipe, spesifikasi, pilihan warna, dan foto kendaraan.</span></a>
<a class="admin-tile" href="<?= e(url('admin/manage.php?type=branches')) ?>"><strong>Kelola Cabang</strong><span>Alamat, WhatsApp, Maps, dan jam operasional.</span></a>
<a class="admin-tile" href="<?= e(url('admin/manage.php?type=promos')) ?>"><strong>Kelola Promo</strong><span>Publikasikan promo dan tanggal berakhir.</span></a>
<a class="admin-tile" href="<?= e(url('admin/manage.php?type=articles')) ?>"><strong>Kelola Artikel</strong><span>Tulis artikel dan atur status publikasi.</span></a>
<a class="admin-tile" href="<?= e(url('admin/settings.php')) ?>"><strong>Pengaturan Beranda</strong><span>Ubah judul dan deskripsi hero.</span></a>
<a class="admin-tile" href="<?= e(url()) ?>" target="_blank"><strong>Lihat Website ↗</strong><span>Buka tampilan publik website.</span></a>
</div><p class="notice">Sebelum website dipublikasikan, isi alamat dan kontak cabang yang masih kosong serta periksa seluruh informasi.</p>
</div></main>
<?php require dirname(__DIR__) . '/includes/footer.php'; ?>
