<?php
require_once __DIR__ . '/bootstrap.php';

function site_header(string $title = APP_NAME, string $active = ''): void
{
    $fullTitle = $title === APP_NAME ? APP_NAME : $title . ' — ' . APP_NAME;
    ?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#06162f">
  <meta name="description" content="Portal resmi PSTI Jawa Timur: blog, tracer atlet, tracer pelatih, anggota, kompetisi, agenda, dan galeri.">
  <title><?= e($fullTitle) ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">
  <link rel="manifest" href="<?= e(base_url('manifest.webmanifest')) ?>">
  <link rel="apple-touch-icon" href="<?= e(base_url('assets/logo.png')) ?>">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
  <meta name="apple-mobile-web-app-title" content="PSTI Jatim">
  <meta name="mobile-web-app-capable" content="yes">
  <link rel="stylesheet" href="<?= e(base_url('assets/css/style.css?v=20260508')) ?>">
</head>
<body>
<a class="skip-link" href="#main-content">Lewati ke konten</a>
<div class="top-strip"><div class="container top-strip-inner"><span>Asosiasi Provinsi Sepak Takraw Jawa Timur</span><span>Blog · Tracer · Anggota · Kompetisi · Agenda</span></div></div>
<header class="site-header">
  <div class="container nav-wrap">
    <a class="brand" href="<?= e(base_url('')) ?>">
      <img src="<?= e(base_url('assets/logo.png')) ?>" alt="Logo PSTI Jatim" onerror="this.style.display='none'">
      <span><b>PSTI Jatim</b><small>Persatuan Sepak Takraw Jawa Timur</small></span>
    </a>
    <button class="nav-toggle" type="button" data-nav-toggle>☰ Menu</button>
    <nav class="nav" data-nav>
      <?php
      $items = [
          'home' => ['/', 'Beranda'],
          'berita' => ['/blog.php', 'Blog'],
          'tracer-atlet' => ['/tracer-atlet.php', 'Tracer Atlet'],
          'tracer-pelatih' => ['/tracer-pelatih.php', 'Tracer Pelatih'],
          'anggota' => ['/anggota.php', 'Anggota'],
          'kompetisi' => ['/kompetisi.php', 'Kompetisi'],
          'agenda' => ['/agenda-jadwal.php', 'Agenda & Jadwal'],
          'galeri' => ['/galeri.php', 'Galeri'],
      ];
      foreach ($items as $key => [$href, $label]) {
          $class = $active === $key ? 'active' : '';
          echo '<a class="' . $class . '" href="' . e(base_url($href)) . '">' . e($label) . '</a>';
      }
      ?>
      <a class="btn btn-small nav-cta" href="<?= e(base_url('admin/')) ?>">Admin</a>
    </nav>
  </div>
</header>
<main id="main-content">
    <?php
}

function site_footer(): void
{
    ?>
</main>
<footer class="site-footer">
  <div class="container footer-grid">
    <div>
      <h3>PSTI Jawa Timur</h3>
      <p>Website resmi sekaligus blog/media center dan sistem informasi organisasi olahraga untuk pembinaan, keanggotaan, agenda, dan prestasi sepak takraw Jawa Timur.</p>
    </div>
    <div>
      <h4>Navigasi</h4>
      <a href="<?= e(base_url('blog.php')) ?>">Blog</a>
      <a href="<?= e(base_url('agenda-jadwal.php')) ?>">Agenda & Jadwal</a>
      <a href="<?= e(base_url('galeri.php')) ?>">Galeri</a>
      <a href="<?= e(base_url('tracer-atlet.php')) ?>">Tracer Atlet</a>
      <a href="<?= e(base_url('aplikasi.php')) ?>">Aplikasi</a>
    </div>
    <div>
      <h4>Modul Utama</h4>
      <a href="<?= e(base_url('anggota.php')) ?>">Anggota</a>
      <a href="<?= e(base_url('kompetisi.php')) ?>">Kompetisi</a>
      <a href="<?= e(base_url('admin/')) ?>">Admin</a>
    </div>
  </div>
  <div class="container copyright">© <?= date('Y') ?> PSTI Jawa Timur. All rights reserved.</div>
</footer>

<nav class="mobile-bottom-nav" aria-label="Navigasi cepat mobile">
  <a href="<?= e(base_url('')) ?>"><span>⌂</span>Beranda</a>
  <a href="<?= e(base_url('blog.php')) ?>"><span>✦</span>Blog</a>
  <a href="<?= e(base_url('tracer-atlet.php')) ?>"><span>◉</span>Atlet</a>
  <a href="<?= e(base_url('kompetisi.php')) ?>"><span>▣</span>Kompetisi</a>
  <a href="<?= e(base_url('aplikasi.php')) ?>"><span>⬇</span>App</a>
</nav>
<div class="install-toast" data-install-toast hidden>
  <div><b>Pasang PSTI Jatim</b><small>Buka lebih cepat dari layar utama HP.</small></div>
  <button type="button" data-install-accept>Install</button>
  <button type="button" class="ghost" data-install-close>×</button>
</div>

<script src="<?= e(base_url('assets/js/main.js?v=20260508')) ?>"></script>
</body>
</html>
    <?php
}

function admin_header(string $title = 'Dashboard', string $active = ''): void
{
    require_login();
    ?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($title) ?> — Admin PSTI Jatim</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= e(base_url('assets/css/admin.css?v=20260508')) ?>">
</head>
<body class="admin-body">
<aside class="admin-sidebar">
  <a class="admin-brand" href="<?= e(base_url('admin/')) ?>"><img src="<?= e(base_url('assets/logo.png')) ?>" alt=""><span><b>PSTI Jatim</b><small>Content Center</small></span></a>
  <nav>
    <?php
    $items = [
        'dashboard' => ['/admin/', 'Dashboard'],
        'berita' => ['/admin/berita.php', 'Berita'],
        'agenda' => ['/admin/agenda.php', 'Agenda'],
        'galeri' => ['/admin/galeri.php', 'Galeri'],
        'tutorial' => ['/admin/tutorial.php', 'Tutorial'],
        'site' => ['/', 'Lihat Website'],
    ];
    foreach ($items as $key => [$href, $label]) {
        $class = $active === $key ? 'active' : '';
        echo '<a class="' . $class . '" href="' . e(base_url($href)) . '">' . e($label) . '</a>';
    }
    ?>
  </nav>
</aside>
<div class="admin-main">
  <header class="admin-topbar">
    <div><h1><?= e($title) ?></h1><p>Kelola konten portal PSTI Jawa Timur.</p></div>
    <div class="admin-user"><?= e((string)(current_user()['name'] ?? current_user()['username'] ?? 'Admin')) ?> · <a href="<?= e(base_url('admin/logout.php')) ?>">Logout</a></div>
  </header>
  <?php foreach (flashes() as $item): ?>
    <div class="alert alert-<?= e($item['type']) ?>"><?= e($item['message']) ?></div>
  <?php endforeach; ?>
    <?php
}

function admin_footer(): void
{
    ?>
</div>
</body>
</html>
    <?php
}
