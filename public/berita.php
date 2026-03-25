<?php $pageTitle = 'PSTI Jatim - Berita'; include __DIR__ . '/../includes/head.php'; include __DIR__ . '/../includes/navbar.php';
$news = json_decode(file_get_contents(__DIR__ . '/../data/berita.json'), true) ?? [];
?>
<section class="max-w-7xl mx-auto px-4 py-12">
  <h1 class="text-3xl font-bold text-pstiBlue">Berita Terbaru</h1>
  <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
    <?php foreach ($news as $item):
      $img = $item['image'] ?? 'https://picsum.photos/seed/news/800/500';
      if (!preg_match('~^https?://|^/~', $img)) { $img = '/' . ltrim($img, '/'); }
      $excerpt = trim($item['excerpt'] ?? '');
      if ($excerpt === '') { $excerpt = 'Klik sumber untuk membaca informasi lengkap.'; }
      $sourceName = $item['source_name'] ?? '';
      $sourceUrl = $item['source_url'] ?? '';
    ?>
      <article class="bg-white rounded-xl shadow-sm overflow-hidden">
        <img src="<?= htmlspecialchars($img) ?>" alt="" class="w-full h-44 object-cover">
        <div class="p-5">
          <p class="text-xs text-slate-500"><?= htmlspecialchars($item['date'] ?? '') ?></p>
          <h2 class="font-bold mt-2"><?= htmlspecialchars($item['title'] ?? '') ?></h2>
          <p class="text-sm text-slate-600 mt-2"><?= htmlspecialchars(mb_strimwidth($excerpt, 0, 220, '...')) ?></p>
          <?php if ($sourceName || $sourceUrl): ?>
            <p class="text-xs text-slate-500 mt-3">Sumber: <?= htmlspecialchars($sourceName) ?></p>
          <?php endif; ?>
          <?php if ($sourceUrl): ?>
            <a href="<?= htmlspecialchars($sourceUrl) ?>" target="_blank" class="text-pstiBlue text-sm font-semibold">Baca selengkapnya →</a>
          <?php endif; ?>
        </div>
      </article>
    <?php endforeach; ?>
  </div>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
