<?php
require __DIR__ . '/config/config.php';
$message = '';
$error = '';
try {
    // Membuat tabel database lebih dulu lewat database.sql di phpMyAdmin.
    $count = (int)db()->query('SELECT COUNT(*) FROM admins')->fetchColumn();
    if ($count > 0) {
        $message = 'Akun admin sudah dibuat. Demi keamanan, hapus file setup.php sekarang.';
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        verify_csrf();
        $name = trim((string)($_POST['name'] ?? ''));
        $email = trim((string)($_POST['email'] ?? ''));
        $password = (string)($_POST['password'] ?? '');
        if ($name === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 12) {
            $error = 'Isi nama dan email valid. Password minimal 12 karakter.';
        } else {
            $stmt = db()->prepare('INSERT INTO admins (name,email,password_hash) VALUES (?,?,?)');
            $stmt->execute([$name, $email, password_hash($password, PASSWORD_DEFAULT)]);
            $message = 'Akun admin berhasil dibuat. Hapus file setup.php, lalu login melalui /admin/login.php.';
        }
    }
} catch (Throwable $ex) {
    $error = 'Database belum siap. Import database.sql melalui phpMyAdmin dan pastikan konfigurasi config/config.php benar.';
}
?>
<!doctype html><html lang="id"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Setup Admin</title><link rel="stylesheet" href="<?= e(url('assets/css/style.css')) ?>"></head><body><main class="page-content"><div class="container" style="max-width:560px"><h1 class="page-title">Setup Admin</h1><p class="page-lead">Buat akun admin pertama website.</p><?php if ($message): ?><p class="notice success"><?= e($message) ?></p><?php endif; ?><?php if ($error): ?><p class="notice error"><?= e($error) ?></p><?php endif; ?><?php if (!$message): ?><form method="post" class="admin-form"><input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>"><label>Nama<input name="name" required maxlength="120"></label><label>Email<input name="email" type="email" required maxlength="190"></label><label>Password (minimal 12 karakter)<input name="password" type="password" minlength="12" required autocomplete="new-password"></label><button class="btn btn-red" type="submit">Buat Akun Admin</button></form><?php endif; ?></div></main></body></html>
