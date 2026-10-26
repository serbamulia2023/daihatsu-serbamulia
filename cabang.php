
<?php
require __DIR__ . '/config/config.php';

$slug = trim((string)($_GET['slug'] ?? ''));

$stmt = db()->prepare(
    'SELECT * FROM branches WHERE slug = ? AND is_active = 1 LIMIT 1'
);
$stmt->execute([$slug]);
$branch = $stmt->fetch();

if (!$branch) {
    http_response_code(404);

    $pageTitle = 'Cabang tidak ditemukan';

    require __DIR__ . '/includes/header.php';
    ?>
    <main class="container page-content">
        <h1>Cabang tidak ditemukan</h1>
        <p>Silakan kembali ke daftar cabang.</p>
        <a class="btn btn-red" href="<?= e(url()) ?>#cabang">
            Lihat Cabang
        </a>
    </main>
    <?php
    require __DIR__ . '/includes/footer.php';
    exit;
}

$pageTitle = 'Daihatsu ' . $branch['name'] . ' | Serba Mulia Auto';

$description = 'Informasi dealer Daihatsu Serba Mulia Auto '
    . $branch['name']
    . ', alamat, kontak, dan layanan.';

require __DIR__ . '/includes/header.php';

$branchPhoto = trim((string)($branch['image_url'] ?? ''));
?>

<main class="page-content">
    <div class="container">

        <!-- Breadcrumb -->
        <div class="breadcrumb">
            <a href="<?= e(url()) ?>">Beranda</a>
            / Dealer /
            <?= e($branch['name']) ?>
        </div>

        <!-- Foto Cabang -->
        <section class="branch-detail-hero">

            <?php if ($branchPhoto !== ''): ?>
                <div class="branch-detail-photo">
                    <img
                        src="<?= e($branchPhoto) ?>"
                        alt="Foto dealer Daihatsu Serba Mulia Auto <?= e($branch['name']) ?>"
                        loading="eager"
                    >
                </div>
            <?php else: ?>
                <div class="branch-detail-photo branch-detail-photo-empty">
                    <div>
                        <span>FOTO DEALER</span>
                        <p>
                            Tambahkan foto cabang melalui
                            menu Admin &gt; Kelola Cabang.
                        </p>
                    </div>
                </div>
            <?php endif; ?>

            <div class="branch-hero">
                <div class="eyebrow">
                    <?= e($branch['region']) ?>
                </div>

                <h1>Daihatsu <?= e($branch['name']) ?></h1>

                <p>
                    <?= e(
                        $branch['description']
                        ?: 'Hubungi tim cabang Serba Mulia Auto untuk informasi penjualan dan layanan Daihatsu.'
                    ) ?>
                </p>

                <div class="hero-actions">
                    <?php if (!empty($branch['whatsapp'])): ?>
                        <?php
                        $whatsappNumber = preg_replace(
                            '/\D+/',
                            '',
                            $branch['whatsapp']
                        );
                        ?>

                        <a
                            class="btn btn-red"
                            target="_blank"
                            rel="noopener noreferrer"
                            href="https://wa.me/<?= e($whatsappNumber) ?>"
                        >
                            Hubungi WhatsApp
                        </a>
                    <?php endif; ?>

                    <?php if (!empty($branch['maps_url'])): ?>
                        <a
                            class="btn btn-outline"
                            target="_blank"
                            rel="noopener noreferrer"
                            href="<?= e($branch['maps_url']) ?>"
                        >
                            Buka Google Maps
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <!-- Informasi Cabang -->
        <div class="branch-detail-grid">

            <article class="detail-panel">
                <h2>Informasi Cabang</h2>

                <p>
                    <strong>Alamat</strong><br>
                    <?= nl2br(e($branch['address'] ?: 'Alamat belum diisi.')) ?>
                </p>

                <p>
                    <strong>Telepon / WhatsApp</strong><br>
                    <?= e($branch['whatsapp'] ?: 'Kontak belum diisi.') ?>
                </p>

                <p>
                    <strong>Jam operasional</strong><br>
                    <?= nl2br(e(
                        $branch['hours']
                        ?: 'Silakan hubungi cabang untuk informasi jam operasional.'
                    )) ?>
                </p>

                <?php
                $socialLinks = [
                    'Facebook' => [
                        'url' => trim((string)($branch['facebook_url'] ?? '')),
                        'icon' => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path fill="currentColor" d="M13.4 21v-8.2h2.8l.4-3.2h-3.2V7.5c0-.9.3-1.6 1.6-1.6h1.7V3.1c-.3 0-1.3-.1-2.5-.1-2.5 0-4.2 1.5-4.2 4.3v2.4H7.2v3.2H10V21h3.4z"/></svg>',
                    ],
                    'Instagram' => [
                        'url' => trim((string)($branch['instagram_url'] ?? '')),
                        'icon' => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><rect x="3.2" y="3.2" width="17.6" height="17.6" rx="5.2" fill="none" stroke="currentColor" stroke-width="2"/><circle cx="12" cy="12" r="4.1" fill="none" stroke="currentColor" stroke-width="2"/><circle cx="17.7" cy="6.5" r="1.2" fill="currentColor"/></svg>',
                    ],
                    'TikTok' => [
                        'url' => trim((string)($branch['tiktok_url'] ?? '')),
                        'icon' => '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path fill="currentColor" d="M19.6 8.2a7.1 7.1 0 0 1-4.3-1.4v7.1a5.6 5.6 0 1 1-4.8-5.5v3.5a2.2 2.2 0 1 0 1.4 2.1V2.8h3.4c.2 2.2 1.7 3.9 4.3 4.2v1.2z"/></svg>',
                    ],
                ];
                $socialLinks = array_filter(
                    $socialLinks,
                    static fn(array $social): bool => $social['url'] !== ''
                );
                ?>

                <?php if ($socialLinks): ?>
                    <div class="branch-social-section">
                        <h3>Media Sosial Cabang</h3>
                        <p>Ikuti akun resmi cabang ini untuk melihat informasi dan aktivitas terbaru.</p>
                        <div class="branch-social-links">
                            <?php foreach ($socialLinks as $socialName => $social): ?>
                                <a
                                    class="branch-social-link branch-social-link--<?= strtolower(e($socialName)) ?>"
                                    href="<?= e($social['url']) ?>"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    aria-label="Buka <?= e($socialName) ?> cabang <?= e($branch['name']) ?> di tab baru"
                                    title="<?= e($socialName) ?>"
                                >
                                    <span class="branch-social-icon" aria-hidden="true"><?= $social['icon'] ?></span>
                                    <span class="branch-social-name"><?= e($socialName) ?></span>
                                    <span class="branch-social-external" aria-hidden="true">↗</span>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </article>

            <article class="detail-panel">
                <h2>Layanan</h2>

                <ul class="service-list">
                    <li>Informasi dan konsultasi pembelian mobil</li>
                    <li>Permintaan test drive</li>
                    <li>Informasi service dan sparepart</li>
                    <li>Informasi promo cabang</li>
                </ul>

                <p class="note">
                    Mohon konfirmasi langsung ke cabang untuk
                    ketersediaan layanan dan jadwal terbaru.
                </p>
            </article>

        </div>

        <p>
            <a class="text-link" href="<?= e(url()) ?>#cabang">
                &larr; Kembali ke semua cabang
            </a>
        </p>

    </div>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
