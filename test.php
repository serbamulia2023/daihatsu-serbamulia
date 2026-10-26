<?php
require_once __DIR__ . '/config/config.php';

try {
    $pdo = db();
    echo "✅ Koneksi Database Berhasil!";
} catch (Throwable $e) {
    echo "❌ Koneksi Gagal: " . $e->getMessage();
}
