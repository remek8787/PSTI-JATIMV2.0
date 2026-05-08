<?php require_once __DIR__ . '/includes/layout.php'; $items = json_read('pengurus'); site_header('Pengurus', 'pengurus'); ?>
<section class="page-hero"><div class="container"><h1>Pengurus PSTI Jatim</h1><p>Struktur organisasi dan pengurus Persatuan Sepak Takraw Indonesia Jawa Timur.</p></div></section>
<section class="section"><div class="container grid-3">
<?php foreach ($items as $item): ?>
  <article class="card"><img class="card-img" src="<?= e(normalize_image($item['foto'] ?? '')) ?>" alt=""><div class="card-body"><span class="badge"><?= e((string)($item['kategori'] ?? 'Pengurus')) ?></span><h3><?= e((string)($item['nama'] ?? 'Nama Pengurus')) ?></h3><p><?= e((string)($item['jabatan'] ?? '')) ?></p></div></article>
<?php endforeach; if (!$items): ?><div class="content">Data pengurus belum tersedia.</div><?php endif; ?>
</div></section><?php site_footer(); ?>
