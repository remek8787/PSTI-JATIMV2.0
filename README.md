# PSTI JATIM V2.0

Website profil organisasi PSTI Jawa Timur (responsive mobile/desktop) dengan stack:
- PHP (modular include)
- Tailwind CSS (CDN)
- Bootstrap 5 (Admin panel)
- Vanilla JavaScript

## Struktur
- `public/index.php` → landing page utama
- `public/profil.php` → profil organisasi
- `public/berita.php` → daftar berita
- `public/galeri.php` → galeri kegiatan
- `public/kontak.php` → kontak + form
- `admin/index.php` → dashboard admin
- `admin/berita.php` → manajemen berita (UI)
- `includes/` → partial reusable
- `api/contact.php` → endpoint simulasi kirim pesan
- `data/berita.json` → sumber data berita sederhana

## Menjalankan lokal
```bash
php -S localhost:8080 -t .
```
Lalu buka:
- http://localhost:8080/public/
- http://localhost:8080/admin/

## Catatan
Template ini siap dikembangkan untuk produksi (auth admin, database, upload media, dsb).
