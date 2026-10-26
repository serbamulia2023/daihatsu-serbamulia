
<?php
require __DIR__ . '/config/config.php';

$pageTitle = 'Promo Daihatsu | Serba Mulia Auto';
$description = 'Lihat promo mobil Daihatsu terbaru dari Serba Mulia Auto di Samarinda, Balikpapan, Paser, Sorong, dan Jayapura.';

$sql = "
    SELECT
        p.*,
        b.name AS branch_name,
        b.whatsapp AS branch_whatsapp
    FROM promos p
    LEFT JOIN branches b ON p.branch_id = b.id
    WHERE p.is_active = 1
      AND (p.end_date IS NULL OR p.end_date >= CURDATE())
    ORDER BY p.created_at DESC
";

$promos = db()->query($sql)->fetchAll();

require __DIR__ . '/includes/header.php';
?>

<main class="page-content">
    <div class="container">

        <div class="eyebrow">Penawaran</div>
        <h1 class="page-title">Promo Daihatsu</h1>

        <p class="page-lead">
            Temukan penawaran Daihatsu dari Serba Mulia Auto.
            Hubungi cabang terkait untuk memastikan syarat dan
            periode promo yang berlaku.
        </p>

        <div class="promo-list">

            <?php foreach ($promos as $p): ?>

                <?php
                $promoImage = trim((string)($p['image_url'] ?? ''));
                // Gunakan nomor khusus promo jika diisi; jika tidak, gunakan nomor cabang.
                $selectedWhatsapp = trim((string)($p['contact_whatsapp'] ?? '')) !== ''
                    ? (string)$p['contact_whatsapp']
                    : (string)($p['branch_whatsapp'] ?? '');

                $whatsapp = preg_replace('/\D+/', '', $selectedWhatsapp);

                $contactMessage = 'Halo Serba Mulia Auto, saya ingin bertanya tentang promo Daihatsu: '
                    . $p['title'];

                $whatsappUrl = $whatsapp
                    ? 'https://wa.me/' . $whatsapp . '?text=' . rawurlencode($contactMessage)
                    : '';
                ?>

                <article class="promo-card">

                    <?php if ($promoImage !== ''): ?>
                        <div class="promo-image">
                            <img
                                src="<?= e($promoImage) ?>"
                                alt="<?= e($p['title']) ?>"
                                loading="lazy"
                            >
                        </div>
                    <?php else: ?>
                        <div class="promo-image promo-image-empty">
                            <span>Gambar promo belum tersedia</span>
                        </div>
                    <?php endif; ?>

                    <div class="promo-card-body">

                        <span class="tag">
                            <?= e($p['branch_name'] ?: 'Semua Cabang') ?>
                        </span>

                        <h2><?= e($p['title']) ?></h2>

                        <p><?= nl2br(e($p['summary'] ?? '')) ?></p>

                        <?php if (!empty($p['end_date'])): ?>
                            <p class="promo-period">
                                <strong>Berakhir:</strong>
                                <?= e(date('d-m-Y', strtotime($p['end_date']))) ?>
                            </p>
                        <?php endif; ?>

                        <div class="promo-contact">
                            <?php if ($whatsapp): ?>
                                <a
                                    class="btn btn-red"
                                    href="<?= e($whatsappUrl) ?>"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                >
                                    Hubungi WhatsApp
                                </a>
                            <?php else: ?>
                                <a
                                    class="btn btn-outline"
                                    href="<?= e(url()) ?>#cabang"
                                >
                                    Cari Kontak Cabang
                                </a>
                            <?php endif; ?>
                        </div>

                    </div>
                </article>

            <?php endforeach; ?>

            <?php if (!$promos): ?>
                <div class="promo-empty">
                    <h2>Belum Ada Promo Aktif</h2>
                    <p>
                        Silakan hubungi dealer Serba Mulia Auto
                        terdekat untuk informasi penawaran Daihatsu.
                    </p>
                    <a
                        class="btn btn-red"
                        href="<?= e(url()) ?>#cabang"
                    >
                        Cari Dealer
                    </a>
                </div>
            <?php endif; ?>

        </div>
    </div>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
