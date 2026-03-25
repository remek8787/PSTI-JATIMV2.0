<?php $pageTitle = 'Admin - Kelola Berita'; include __DIR__ . '/../includes/head.php'; include __DIR__ . '/../includes/navbar.php'; ?>
<section class="container py-5">
  <h1 class="h3">Kelola Berita</h1>
  <div class="card mt-4">
    <div class="card-body">
      <form class="row g-3">
        <div class="col-md-6"><input class="form-control" placeholder="Judul berita"></div>
        <div class="col-md-3"><input class="form-control" type="date"></div>
        <div class="col-12"><textarea class="form-control" rows="4" placeholder="Ringkasan"></textarea></div>
        <div class="col-12"><button class="btn btn-primary" type="button">Simpan (UI Demo)</button></div>
      </form>
    </div>
  </div>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
