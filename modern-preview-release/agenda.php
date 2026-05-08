<?php require_once __DIR__ . '/includes/layout.php'; $items = sort_by_date_desc(json_read('agenda'), 'tanggal'); site_header('Agenda', 'agenda'); ?>
<section class="page-hero"><div class="container"><h1>Agenda Kegiatan</h1><p>Jadwal kegiatan, kompetisi, pembinaan, rapat kerja, dan event PSTI Jawa Timur.</p></div></section>
<section class="section"><div class="container grid-3">
<?php foreach ($items as $item): ?>
  <article class="feature"><span class="badge"><?= e((string)($item['status'] ?? 'Terjadwal')) ?></span><h3><?= e((string)($item['title'] ?? $item['kegiatan'] ?? 'Agenda PSTI')) ?></h3><p><?= e((string)($item['tanggal'] ?? $item['periode'] ?? '')) ?></p><p><?= e((string)($item['lokasi'] ?? $item['deskripsi'] ?? '')) ?></p></article>
<?php endforeach; if (!$items): ?><div class="content">Belum ada agenda.</div><?php endif; ?>
</div></section><?php site_footer(); ?>
