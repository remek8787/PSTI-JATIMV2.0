<?php require_once __DIR__ . '/../includes/layout.php'; admin_header('Kelola Galeri', 'galeri');
$items = sort_by_date_desc(json_read('galeri'), 'created_at');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf(); $action=(string)($_POST['action']??''); $items=json_read('galeri');
    try{
        if($action==='save'){
            $id=(int)($_POST['id']??0); $idx=null; $old=null; foreach($items as $i=>$it){ if((int)($it['id']??0)===$id){$idx=$i;$old=$it['image']??null;}}
            if($id<=0)$id=next_id($items); $image=upload_image('image','galeri',$old) ?: ($old ?: '');
            $record=['id'=>$id,'title'=>trim((string)($_POST['title']??'')),'category'=>trim((string)($_POST['category']??'Kegiatan')),'caption'=>trim((string)($_POST['caption']??'')),'image'=>$image,'created_at'=>date('Y-m-d H:i:s')];
            if($record['title']==='') throw new RuntimeException('Judul foto wajib diisi.'); if($record['image']==='') throw new RuntimeException('Gambar wajib diupload.');
            if($idx===null)$items[]=$record; else $items[$idx]=array_merge($items[$idx],$record); json_write('galeri',$items); flash('success','Galeri berhasil disimpan.');
        }
        if($action==='delete'){ $id=(int)($_POST['id']??0); $items=array_values(array_filter($items,fn($it)=>(int)($it['id']??0)!==$id)); json_write('galeri',$items); flash('success','Galeri berhasil dihapus.'); }
    }catch(Throwable $e){ flash('error',$e->getMessage()); }
    header('Location: ' . base_url('admin/galeri.php')); exit;
}
$edit=null; if(isset($_GET['edit'])) foreach($items as $it) if((int)($it['id']??0)===(int)$_GET['edit']) $edit=$it;
?>
<div class="panel"><div class="toolbar"><h2><?= $edit?'Edit Galeri':'Tambah Galeri' ?></h2><a class="btn secondary" href="<?= e(base_url('admin/galeri.php')) ?>">Reset</a></div><form method="post" enctype="multipart/form-data" class="form-grid"><?= csrf_field() ?><input type="hidden" name="action" value="save"><input type="hidden" name="id" value="<?= (int)($edit['id']??0) ?>"><div class="field"><label>Judul</label><input name="title" required value="<?= e((string)($edit['title']??'')) ?>"></div><div class="field"><label>Kategori</label><input name="category" value="<?= e((string)($edit['category']??'Kegiatan')) ?>"></div><div class="field"><label>Gambar</label><input type="file" name="image" accept="image/*"></div><div class="field full"><label>Caption</label><textarea name="caption"><?= e((string)($edit['caption']??'')) ?></textarea></div><div class="field full"><button class="btn">Simpan Galeri</button></div></form></div>
<div class="panel"><div class="toolbar"><h2>Daftar Galeri</h2><span class="muted"><?= count($items) ?> item</span></div><div class="table-wrap"><table><thead><tr><th>Judul</th><th>Kategori</th><th>Gambar</th><th>Aksi</th></tr></thead><tbody><?php foreach($items as $it): ?><tr><td><b><?= e((string)($it['title']??'')) ?></b></td><td><?= e((string)($it['category']??'')) ?></td><td><?= e((string)($it['image']??'')) ?></td><td class="actions"><a class="btn secondary" href="?edit=<?= (int)$it['id'] ?>">Edit</a><form method="post" onsubmit="return confirm('Hapus galeri ini?')"><?= csrf_field() ?><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= (int)$it['id'] ?>"><button class="btn danger">Hapus</button></form></td></tr><?php endforeach; ?></tbody></table></div></div><?php admin_footer(); ?>
