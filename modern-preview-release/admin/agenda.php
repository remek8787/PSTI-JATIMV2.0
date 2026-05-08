<?php require_once __DIR__ . '/../includes/layout.php'; admin_header('Kelola Agenda', 'agenda');
$items = sort_by_date_desc(json_read('agenda'), 'tanggal');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf(); $action = (string)($_POST['action'] ?? ''); $items = json_read('agenda');
    try {
        if ($action === 'save') {
            $id = (int)($_POST['id'] ?? 0); $idx = null; foreach ($items as $i => $it) { if ((int)($it['id'] ?? 0) === $id) $idx = $i; }
            if ($id <= 0) $id = next_id($items);
            $record = ['id'=>$id,'title'=>trim((string)($_POST['title'] ?? '')),'kegiatan'=>trim((string)($_POST['title'] ?? '')),'tanggal'=>trim((string)($_POST['tanggal'] ?? '')),'lokasi'=>trim((string)($_POST['lokasi'] ?? '')),'status'=>trim((string)($_POST['status'] ?? 'Terjadwal')),'deskripsi'=>trim((string)($_POST['deskripsi'] ?? '')),'created_at'=>date('Y-m-d H:i:s')];
            if ($record['title'] === '') throw new RuntimeException('Judul agenda wajib diisi.');
            if ($idx === null) $items[] = $record; else $items[$idx] = array_merge($items[$idx], $record);
            json_write('agenda', $items); flash('success', 'Agenda berhasil disimpan.');
        }
        if ($action === 'delete') { $id=(int)($_POST['id']??0); $items=array_values(array_filter($items,fn($it)=>(int)($it['id']??0)!==$id)); json_write('agenda',$items); flash('success','Agenda berhasil dihapus.'); }
    } catch (Throwable $e) { flash('error',$e->getMessage()); }
    header('Location: ' . base_url('admin/agenda.php')); exit;
}
$edit=null; if(isset($_GET['edit'])) foreach($items as $it) if((int)($it['id']??0)===(int)$_GET['edit']) $edit=$it;
?>
<div class="panel"><div class="toolbar"><h2><?= $edit?'Edit Agenda':'Tambah Agenda' ?></h2><a class="btn secondary" href="<?= e(base_url('admin/agenda.php')) ?>">Reset</a></div><form method="post" class="form-grid"><?= csrf_field() ?><input type="hidden" name="action" value="save"><input type="hidden" name="id" value="<?= (int)($edit['id']??0) ?>"><div class="field"><label>Judul Agenda</label><input name="title" required value="<?= e((string)($edit['title'] ?? $edit['kegiatan'] ?? '')) ?>"></div><div class="field"><label>Tanggal/Periode</label><input name="tanggal" value="<?= e((string)($edit['tanggal'] ?? $edit['periode'] ?? '')) ?>"></div><div class="field"><label>Lokasi</label><input name="lokasi" value="<?= e((string)($edit['lokasi'] ?? '')) ?>"></div><div class="field"><label>Status</label><select name="status"><option>Terjadwal</option><option>Berlangsung</option><option>Selesai</option></select></div><div class="field full"><label>Deskripsi</label><textarea name="deskripsi"><?= e((string)($edit['deskripsi'] ?? '')) ?></textarea></div><div class="field full"><button class="btn">Simpan Agenda</button></div></form></div>
<div class="panel"><div class="toolbar"><h2>Daftar Agenda</h2><span class="muted"><?= count($items) ?> item</span></div><div class="table-wrap"><table><thead><tr><th>Agenda</th><th>Waktu</th><th>Lokasi</th><th>Status</th><th>Aksi</th></tr></thead><tbody><?php foreach($items as $it): ?><tr><td><b><?= e((string)($it['title'] ?? $it['kegiatan'] ?? '')) ?></b></td><td><?= e((string)($it['tanggal'] ?? $it['periode'] ?? '')) ?></td><td><?= e((string)($it['lokasi'] ?? '')) ?></td><td><?= e((string)($it['status'] ?? '')) ?></td><td class="actions"><a class="btn secondary" href="?edit=<?= (int)$it['id'] ?>">Edit</a><form method="post" onsubmit="return confirm('Hapus agenda ini?')"><?= csrf_field() ?><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= (int)$it['id'] ?>"><button class="btn danger">Hapus</button></form></td></tr><?php endforeach; ?></tbody></table></div></div><?php admin_footer(); ?>
