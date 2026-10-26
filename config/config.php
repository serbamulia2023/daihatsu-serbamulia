<?php

declare(strict_types=1);

define('SITE_NAME', 'Serba Mulia Auto Daihatsu');
define('BASE_URL', 'https://daihatsu.serbamulia.co.id');
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'serba_mulia_daihatsu');
define('DB_USER', 'user_daihatsu');
define('DB_PASS', '2jQA.P9h_3zQmsN/');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function db(): PDO
{
    static $pdo = null;
    if ($pdo instanceof PDO) return $pdo;
    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4';
    $pdo = new PDO($dsn, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
    return $pdo;
}

function e(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}
function url(string $path = ''): string
{
    return rtrim(BASE_URL, '/') . ($path !== '' ? '/' . ltrim($path, '/') : '/');
}
function redirect(string $path): never
{
    header('Location: ' . url($path));
    exit;
}
function csrf_token(): string
{
    if (empty($_SESSION['csrf_token'])) $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    return $_SESSION['csrf_token'];
}
function verify_csrf(): void
{
    $sent = $_POST['csrf_token'] ?? '';
    if (!is_string($sent) || !hash_equals(csrf_token(), $sent)) {
        http_response_code(419);
        exit('Sesi formulir tidak valid. Silakan kembali dan muat ulang halaman.');
    }
}
function is_admin(): bool
{
    return !empty($_SESSION['admin_id']);
}
function require_admin(): void
{
    if (!is_admin()) redirect('admin/login.php');
}
function setting(string $key, string $default = ''): string
{
    try {
        $stmt = db()->prepare('SELECT setting_value FROM settings WHERE setting_key = ? LIMIT 1');
        $stmt->execute([$key]);
        $value = $stmt->fetchColumn();
        return $value === false ? $default : (string)$value;
    } catch (Throwable $ex) {
        return $default;
    }
}
function set_setting(string $key, string $value): void
{
    $pdo = db();
    $check = $pdo->prepare('SELECT 1 FROM settings WHERE setting_key = ? LIMIT 1');
    $check->execute([$key]);
    if ($check->fetchColumn()) {
        $stmt = $pdo->prepare('UPDATE settings SET setting_value = ? WHERE setting_key = ?');
        $stmt->execute([$value, $key]);
        return;
    }
    $stmt = $pdo->prepare('INSERT INTO settings (setting_key, setting_value) VALUES (?, ?)');
    $stmt->execute([$key, $value]);
}
