<?php $pageTitle = 'Admin - Dashboard PSTI Jatim'; include __DIR__ . '/../includes/head.php'; ?>
<div class="d-flex" style="min-height:100vh;">
  <aside class="bg-dark text-white p-3" style="width:260px;">
    <h3 class="h5">Admin PSTI</h3>
    <ul class="nav flex-column gap-2 mt-4">
      <li><a class="nav-link text-white" href="/admin/index.php">Dashboard</a></li>
      <li><a class="nav-link text-white" href="/admin/berita.php">Kelola Berita</a></li>
      <li><a class="nav-link text-white" href="/public/index.php">Lihat Website</a></li>
    </ul>
  </aside>
  <main class="flex-grow-1 p-4">
    <h1 class="h3">Dashboard</h1>
    <div class="row g-3 mt-2">
      <div class="col-md-4"><div class="card"><div class="card-body"><h5>Total Berita</h5><p class="display-6">24</p></div></div></div>
      <div class="col-md-4"><div class="card"><div class="card-body"><h5>Agenda Bulan Ini</h5><p class="display-6">7</p></div></div></div>
      <div class="col-md-4"><div class="card"><div class="card-body"><h5>Pesan Masuk</h5><p class="display-6">13</p></div></div></div>
    </div>
  </main>
</div>
<?php include __DIR__ . '/../includes/footer.php'; ?>
