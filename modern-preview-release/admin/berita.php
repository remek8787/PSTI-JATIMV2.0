<?php require_once __DIR__ . '/../includes/layout.php'; admin_header('Kelola Blog / Berita', 'berita');
$items = sort_by_date_desc(json_read('berita'), 'published_at');
$categories = ['Berita Resmi','Pembinaan','Kompetisi','Atlet & Pelatih','Opini/Tulisan','Pengumuman'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $action = (string)($_POST['action'] ?? '');
    $items = json_read('berita');
    try {
        if ($action === 'save') {
            $id = (int)($_POST['id'] ?? 0);
            $existingIndex = null; $oldBanner = null;
            foreach ($items as $i => $it) {
                if ((int)($it['id'] ?? 0) === $id) { $existingIndex = $i; $oldBanner = $it['banner'] ?? null; break; }
            }
            if ($id <= 0) { $id = next_id($items); }
            $banner = upload_image('banner', 'berita', $oldBanner) ?: ($oldBanner ?: '');
            $record = [
                'id' => $id,
                'title' => trim((string)($_POST['title'] ?? '')),
                'excerpt' => trim((string)($_POST['excerpt'] ?? '')),
                'source_url' => trim((string)($_POST['source_url'] ?? '')),
                'source_name' => trim((string)($_POST['source_name'] ?? '')),
                'category' => trim((string)($_POST['category'] ?? 'Berita Resmi')),
                'tags' => trim((string)($_POST['tags'] ?? '')),
                'status' => trim((string)($_POST['status'] ?? 'publish')),
                'published_at' => trim((string)($_POST['published_at'] ?? date('Y-m-d H:i'))),
                'pinned' => !empty($_POST['pinned']) ? 1 : 0,
                'banner' => $banner,
            ];
            if ($record['title'] === '') { throw new RuntimeException('Judul wajib diisi.'); }
            if (!in_array($record['category'], $categories, true)) { $record['category'] = 'Berita Resmi'; }
            if (!in_array($record['status'], ['publish','draft'], true)) { $record['status'] = 'publish'; }
            if ($existingIndex === null) { $items[] = $record; } else { $items[$existingIndex] = array_merge($items[$existingIndex], $record); }
            json_write('berita', $items); flash('success', 'Artikel berhasil disimpan.');
        }
        if ($action === 'delete') {
            $id = (int)($_POST['id'] ?? 0);
            $items = array_values(array_filter($items, fn($it) => (int)($it['id'] ?? 0) !== $id));
            json_write('berita', $items); flash('success', 'Artikel berhasil dihapus.');
        }
    } catch (Throwable $e) { flash('error', $e->getMessage()); }
    header('Location: ' . base_url('admin/berita.php')); exit;
}
$edit = null;
if (isset($_GET['edit'])) { foreach ($items as $it) { if ((int)($it['id'] ?? 0) === (int)$_GET['edit']) $edit = $it; } }
?>
<div class="panel">
  <div class="toolbar"><h2><?= $edit ? 'Edit Artikel / Berita' : 'Tambah Artikel / Berita' ?></h2><a class="btn secondary" href="<?= e(base_url('admin/berita.php')) ?>">Reset</a></div>
  <form method="post" enctype="multipart/form-data" class="form-grid">
    <?= csrf_field() ?>
    <input type="hidden" name="action" value="save"><input type="hidden" name="id" value="<?= (int)($edit['id'] ?? 0) ?>">
    <div class="field"><label>Judul Artikel</label><input name="title" required value="<?= e((string)($edit['title'] ?? '')) ?>"></div>
    <div class="field"><label>Kategori Blog</label><select name="category"><?php foreach ($categories as $cat): ?><option value="<?= e($cat) ?>" <?= (($edit['category'] ?? 'Berita Resmi') === $cat) ? 'selected' : '' ?>><?= e($cat) ?></option><?php endforeach; ?></select></div>
    <div class="field"><label>Status</label><select name="status"><option value="publish" <?= (($edit['status'] ?? 'publish') === 'publish') ? 'selected' : '' ?>>Publish</option><option value="draft" <?= (($edit['status'] ?? '') === 'draft') ? 'selected' : '' ?>>Draft</option></select></div>
    <div class="field"><label>Tanggal Publish</label><input name="published_at" value="<?= e((string)($edit['published_at'] ?? date('Y-m-d H:i'))) ?>"></div>
    <div class="field"><label>Sumber</label><input name="source_name" value="<?= e((string)($edit['source_name'] ?? '')) ?>"></div>
    <div class="field"><label>URL Sumber</label><input name="source_url" value="<?= e((string)($edit['source_url'] ?? '')) ?>"></div>
    <div class="field full"><label>Tags</label><input name="tags" placeholder="contoh: kejurda, atlet, pembinaan" value="<?= e((string)($edit['tags'] ?? '')) ?>"></div>
    <div class="field full"><label>Isi Artikel / Ringkasan</label><textarea name="excerpt" rows="8"><?= e((string)($edit['excerpt'] ?? '')) ?></textarea></div>
    <div class="field"><label>Gambar Utama</label><input type="file" name="banner" accept="image/*"></div>
    <div class="field"><label><input type="checkbox" name="pinned" value="1" <?= !empty($edit['pinned']) ? 'checked' : '' ?>> Jadikan unggulan</label></div>
    <div class="field full"><button class="btn" type="submit">Simpan Artikel</button></div>
  </form>
</div>
<div class="panel">
  <div class="toolbar"><h2>Daftar Artikel / Berita</h2><span class="muted"><?= count($items) ?> item</span></div>
  <div class="table-wrap"><table><thead><tr><th>Judul</th><th>Kategori</th><th>Status</th><th>Tanggal</th><th>Sumber</th><th>Aksi</th></tr></thead><tbody><?php foreach ($items as $it): ?><tr><td><b><?= e((string)($it['title'] ?? '')) ?></b></td><td><?= e((string)($it['category'] ?? 'Berita Resmi')) ?></td><td><?= e((string)($it['status'] ?? 'publish')) ?></td><td><?= e((string)($it['published_at'] ?? '')) ?></td><td><?= e((string)($it['source_name'] ?? '')) ?></td><td class="actions"><a class="btn secondary" href="?edit=<?= (int)$it['id'] ?>">Edit</a><form method="post" onsubmit="return confirm('Hapus artikel ini?')"><?= csrf_field() ?><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= (int)$it['id'] ?>"><button class="btn danger">Hapus</button></form></td></tr><?php endforeach; ?></tbody></table></div>
</div>
<?php admin_footer(); ?>
