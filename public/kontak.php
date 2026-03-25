<?php $pageTitle = 'PSTI Jatim - Kontak'; include __DIR__ . '/../includes/head.php'; include __DIR__ . '/../includes/navbar.php'; ?>
<section class="max-w-7xl mx-auto px-4 py-12">
  <h1 class="text-3xl font-bold text-pstiBlue">Kontak Kami</h1>
  <div class="grid md:grid-cols-2 gap-8 mt-8">
    <div class="bg-white p-6 rounded-xl shadow-sm">
      <h2 class="font-semibold">Hubungi PSTI Jatim</h2>
      <form id="contactForm" class="space-y-4 mt-4">
        <input class="w-full border rounded-lg px-3 py-2" name="nama" placeholder="Nama" required>
        <input class="w-full border rounded-lg px-3 py-2" type="email" name="email" placeholder="Email" required>
        <textarea class="w-full border rounded-lg px-3 py-2" name="pesan" rows="5" placeholder="Pesan" required></textarea>
        <button class="px-5 py-2 bg-pstiBlue text-white rounded-lg">Kirim</button>
      </form>
      <p id="contactStatus" class="text-sm mt-3"></p>
    </div>
    <div class="bg-white p-6 rounded-xl shadow-sm">
      <h2 class="font-semibold">Informasi Sekretariat</h2>
      <p class="mt-3">Alamat: Surabaya, Jawa Timur</p>
      <p>Email: info@pstijatim.com</p>
      <p>Instagram: @pstijatim (contoh)</p>
    </div>
  </div>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
