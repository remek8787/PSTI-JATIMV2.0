<?php require_once __DIR__ . '/includes/layout.php'; $items = sort_by_date_desc(json_read('galeri'), 'created_at'); site_header('Galeri', 'galeri'); ?>
<section class="page-hero"><div class="container"><h1>Galeri PSTI Jatim</h1><p>Dokumentasi kegiatan, kompetisi, dan pembinaan sepak takraw Jawa Timur.</p></div></section>
<section class="section"><div class="container grid-3">
<?php foreach ($items as $item): ?>
  <article class="card"><img class="card-img" src="<?= e(normalize_image($item['image'] ?? '')) ?>" alt=""><div class="card-body"><span class="badge"><?= e((string)($item['category'] ?? 'Galeri')) ?></span><h3><?= e((string)($item['title'] ?? 'Dokumentasi')) ?></h3><p><?= e((string)($item['caption'] ?? '')) ?></p></div></article>
<?php endforeach; if (!$items): ?><div class="content">Belum ada galeri. Tambahkan lewat admin.</div><?php endif; ?>
</div></section><?php site_footer(); ?>
