<?php
$hqEmail = trim(setting('hq_email'));
$hqWhatsappRaw = trim(setting('hq_whatsapp'));
$hqWhatsappDigits = preg_replace('/\D+/', '', $hqWhatsappRaw);
$hqWhatsappUrl = $hqWhatsappDigits !== '' ? 'https://wa.me/' . $hqWhatsappDigits : '';
?>
<footer class="site-footer">
  <div class="container footer-grid">
    <div><h3>SERBA MULIA AUTO</h3><p>Authorized Dealer Daihatsu. Menyediakan penjualan, test drive, service, dan sparepart melalui jaringan cabang di Kalimantan Timur dan Papua.</p></div>
    <div><h3>Dealer</h3>
      <a href="<?= e(url('cabang.php?slug=samarinda')) ?>">Daihatsu Samarinda</a>
      <a href="<?= e(url('cabang.php?slug=balikpapan')) ?>">Daihatsu Balikpapan</a>
      <a href="<?= e(url('cabang.php?slug=paser')) ?>">Daihatsu Paser</a>
      <a href="<?= e(url('cabang.php?slug=jayapura')) ?>">Daihatsu Jayapura</a>
      <a href="<?= e(url('cabang.php?slug=sorong')) ?>">Daihatsu Sorong</a>
    </div>
    <div><h3>Layanan</h3><a href="<?= e(url()) ?>#mobil">Mobil Daihatsu</a><a href="<?= e(url()) ?>#layanan">Service</a><a href="<?= e(url()) ?>#promo">Promo</a></div>
    <div><h3>Informasi</h3><a href="<?= e(url('artikel.php')) ?>">Artikel</a><a href="<?= e(url()) ?>#tentang">Tentang Kami</a><a href="<?= e(url('admin/login.php')) ?>">Admin</a></div>
    <?php if ($hqEmail !== '' || $hqWhatsappUrl !== ''): ?>
    <div class="footer-contact"><h3>Hubungi Head Office</h3>
      <?php if ($hqEmail !== '' && filter_var($hqEmail, FILTER_VALIDATE_EMAIL)): ?><a href="mailto:<?= e($hqEmail) ?>">Email Head Office</a><?php endif; ?>
      <?php if ($hqWhatsappUrl !== ''): ?><a href="<?= e($hqWhatsappUrl) ?>" target="_blank" rel="noopener noreferrer">WhatsApp Head Office ↗</a><?php endif; ?>
    </div>
    <?php endif; ?>
  </div>
  <div class="container copyright">© <?= date('Y') ?> Serba Mulia Auto. Informasi pada website perlu dikonfirmasi ke cabang terkait.</div>
</footer>
<script src="<?= e(url('assets/js/script.js')) ?>"></script>
</body></html>
