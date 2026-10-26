<?php
require dirname(__DIR__) . '/config/config.php';
require_admin();
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $heroTitle = trim((string)($_POST['hero_title'] ?? ''));
    $heroText = trim((string)($_POST['hero_text'] ?? ''));
    $contactEmail = trim((string)($_POST['hq_email'] ?? ''));
    $contactWhatsapp = trim((string)($_POST['hq_whatsapp'] ?? ''));

    if ($contactEmail !== '' && !filter_var($contactEmail, FILTER_VALIDATE_EMAIL)) {
        $error = 'Format email Head Office tidak valid.';
    } elseif ($contactWhatsapp !== '' && !preg_match('/^[0-9+() .-]{7,30}$/', $contactWhatsapp)) {
        $error = 'Nomor WhatsApp tidak valid. Masukkan nomor dengan kode negara, misalnya 62812xxxxxxx.';
    } else {
        try {
            set_setting('hero_title', $heroTitle);
            set_setting('hero_text', $heroText);
            set_setting('hq_email', $contactEmail);
            set_setting('hq_whatsapp', $contactWhatsapp);
            $success = 'Pengaturan berhasil disimpan.';
        } catch (Throwable $ex) {
            $error = 'Pengaturan gagal disimpan. Pastikan database tersedia.';
        }
    }
}

$pageTitle = 'Pengaturan Website | Admin';
require dirname(__DIR__) . '/includes/header.php';
?>
<main class="page-content">
  <div class="container admin-login">
    <div class="eyebrow">Pengaturan Website</div>
    <h1 class="page-title">Pengaturan Website</h1>
    <p class="page-lead">Atur konten beranda dan kontak resmi Head Office yang ditampilkan pada footer website.</p>
    <?php if ($success): ?><p class="notice success"><?= e($success) ?></p><?php endif; ?>
    <?php if ($error): ?><p class="notice error"><?= e($error) ?></p><?php endif; ?>
    <form method="post" class="admin-form">
      <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
      <h2>Konten Beranda</h2>
      <label>Judul hero<input name="hero_title" required maxlength="220" value="<?= e(setting('hero_title')) ?>"></label>
      <label>Deskripsi hero<textarea name="hero_text" required rows="4"><?= e(setting('hero_text')) ?></textarea></label>
      <h2>Kontak Head Office</h2>
      <p class="form-help">Kontak ini tampil di footer seluruh halaman publik. Kosongkan jika belum ingin menampilkannya.</p>
      <label>Email resmi Head Office<input type="email" name="hq_email" maxlength="254" placeholder="contoh: info@perusahaan.co.id" value="<?= e(setting('hq_email')) ?>"></label>
      <label>WhatsApp Head Office<input type="tel" name="hq_whatsapp" maxlength="30" placeholder="Contoh: 62812xxxxxxx" value="<?= e(setting('hq_whatsapp')) ?>"><small>Gunakan kode negara, misalnya 62, tanpa harus menulis tanda +.</small></label>
      <button class="btn btn-red" type="submit">Simpan Pengaturan</button>
    </form>
    <p style="margin-top:20px"><a class="text-link" href="<?= e(url('admin/index.php')) ?>">← Kembali ke dashboard</a></p>
  </div>
</main>
<?php require dirname(__DIR__) . '/includes/footer.php'; ?>
