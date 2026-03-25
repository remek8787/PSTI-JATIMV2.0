<?php $pageTitle = 'PSTI Jatim - Beranda'; include __DIR__ . '/../includes/head.php'; include __DIR__ . '/../includes/navbar.php'; ?>

<section class="relative overflow-hidden bg-gradient-to-r from-pstiBlue to-blue-600 text-white">
  <div class="max-w-7xl mx-auto px-4 py-20 grid md:grid-cols-2 gap-8 items-center">
    <div>
      <p class="uppercase tracking-widest text-pstiGold font-semibold text-sm">Terinspirasi portal lembaga nasional</p>
      <h1 class="text-4xl md:text-5xl font-extrabold leading-tight mt-3">Persatuan Sepak Takraw Jawa Timur</h1>
      <p class="mt-4 text-slate-100">Bergerak, bersatu, berprestasi. Portal resmi untuk informasi pembinaan, agenda, kompetisi, dan update kegiatan PSTI Jatim.</p>
      <div class="mt-6 flex gap-3 flex-wrap">
        <a class="px-5 py-3 rounded-lg bg-pstiGold text-black font-semibold" href="/public/profil.php">Tentang Kami</a>
        <a class="px-5 py-3 rounded-lg border border-white" href="/public/berita.php">Lihat Berita</a>
      </div>
    </div>
    <div class="grid grid-cols-2 gap-4">
      <div class="card-feature"><h3>120+</h3><p>Atlet Binaan</p></div>
      <div class="card-feature"><h3>38</h3><p>Pengcab Aktif</p></div>
      <div class="card-feature"><h3>16</h3><p>Program Tahunan</p></div>
      <div class="card-feature"><h3>24/7</h3><p>Update Informasi</p></div>
    </div>
  </div>
</section>

<section class="max-w-7xl mx-auto px-4 py-14">
  <div class="grid md:grid-cols-3 gap-6">
    <article class="service-card"><h3>Informasi Terbaru</h3><p>Publikasi berita, pengumuman, dan agenda kompetisi daerah hingga nasional.</p></article>
    <article class="service-card"><h3>Pembinaan Atlet</h3><p>Program pelatihan berjenjang berbasis prestasi dan sport science.</p></article>
    <article class="service-card"><h3>Layanan Organisasi</h3><p>Akses dokumen organisasi, kontak pengurus, dan kemitraan strategis.</p></article>
  </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
