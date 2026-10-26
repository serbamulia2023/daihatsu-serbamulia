
<?php
$pageTitle = $pageTitle ?? SITE_NAME;
$description = $description ?? 'Dealer Daihatsu Serba Mulia Auto. Temukan mobil, cabang, promo, dan layanan Daihatsu.';
?>
<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($pageTitle) ?></title>
<meta name="description" content="<?= e($description) ?>">
<link rel="stylesheet" href="<?= e(url('assets/css/style.css')) ?>">
</head>
<body>

<header class="site-header">
  <div class="container nav-wrap">

    <a class="logo" href="<?= e(url()) ?>" aria-label="Serba Mulia Auto - Beranda">
      <img
        src="<?= e(url('assets/images/Logo Serba mUlia R4.png')) ?>"
        alt="Serba Mulia Auto"
        class="site-logo"
      >
    </a>

    <button
      class="menu-toggle"
      type="button"
      aria-label="Buka menu"
      aria-expanded="false"
    >☰</button>

    <nav class="main-nav" id="mainNav">
      <a href="<?= e(url()) ?>#mobil">Mobil Daihatsu</a>
      <a href="<?= e(url()) ?>#cabang">Dealer</a>
      <a href="<?= e(url()) ?>#layanan">Layanan</a>
      <a href="<?= e(url()) ?>#promo">Promo</a>
      <a href="<?= e(url('artikel.php')) ?>">Artikel</a>
      <a class="btn btn-red nav-cta" href="<?= e(url()) ?>#cabang">Cari Dealer</a>
    </nav>

  </div>
</header>
