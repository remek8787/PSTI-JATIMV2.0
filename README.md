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

## Menjalankan lokal (PHP)
```bash
php -S localhost:8080 -t .
```
Lalu buka:
- http://localhost:8080/public/
- http://localhost:8080/admin/

## Mode GitHub Pages (Static)
File static disediakan agar bisa langsung jalan di GitHub Pages:
- `index.html`
- `profil.html`
- `berita.html`
- `agenda.html`
- `pengurus.html`
- `atlit.html`
- `pelatih.html`
- `klub.html`
- `kompetisi.html`
- `klasemen.html`
- `sponsor.html`
- `galeri.html`
- `kontak.html`
- `admin.html`

Data dan media sudah disinkronkan dari `PSTI-JATIMV1.0` ke:
- `data/*.json`
- `uploads/*`

Aktifkan GitHub Pages dari branch `main` folder `/ (root)`.
Workflow auto-deploy juga sudah disiapkan di `.github/workflows/deploy-pages.yml`.

## Catatan
Template ini siap dikembangkan untuk produksi (auth admin, database, upload media, dsb).
