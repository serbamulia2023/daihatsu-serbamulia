<?php
require dirname(__DIR__) . '/config/config.php';
if (is_admin()) redirect('admin/index.php');
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $email = trim((string)($_POST['email'] ?? ''));
    $password = (string)($_POST['password'] ?? '');
    $stmt = db()->prepare('SELECT id,name,email,password_hash FROM admins WHERE email=? LIMIT 1');
    $stmt->execute([$email]);
    $admin = $stmt->fetch();
    if ($admin && password_verify($password, $admin['password_hash'])) {
        session_regenerate_id(true);
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_name'] = $admin['name'];
        redirect('admin/index.php');
    }
    $error = 'Email atau password tidak sesuai.';
}
$pageTitle = 'Login Admin | ' . SITE_NAME;
require dirname(__DIR__) . '/includes/header.php';
?>
<main class="page-content"><div class="container admin-login"><h1 class="page-title">Login Admin</h1><p class="page-lead">Masuk untuk mengelola konten website Serba Mulia Auto Daihatsu.</p><?php if ($error): ?><p class="notice error"><?= e($error) ?></p><?php endif; ?><form method="post" class="admin-form"><input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>"><label>Email<input name="email" type="email" required autocomplete="username"></label><label>Password<input name="password" type="password" required autocomplete="current-password"></label><button class="btn btn-red" type="submit">Masuk</button></form></div></main>
<?php require dirname(__DIR__) . '/includes/footer.php'; ?>
