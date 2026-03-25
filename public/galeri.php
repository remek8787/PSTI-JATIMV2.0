<?php $pageTitle = 'PSTI Jatim - Galeri'; include __DIR__ . '/../includes/head.php'; include __DIR__ . '/../includes/navbar.php'; ?>
<section class="max-w-7xl mx-auto px-4 py-12">
  <h1 class="text-3xl font-bold text-pstiBlue">Galeri Kegiatan</h1>
  <p class="mt-2 text-slate-600">Dokumentasi latihan, turnamen, dan pembinaan atlet PSTI Jawa Timur.</p>
  <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-8">
    <?php for ($i=1; $i<=8; $i++): ?>
      <div class="bg-white rounded-xl p-2 shadow-sm">
        <img src="https://picsum.photos/seed/takraw<?= $i ?>/500/380" class="rounded-lg w-full h-40 object-cover" alt="Galeri <?= $i ?>">
      </div>
    <?php endfor; ?>
  </div>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
