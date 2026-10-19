# Desa Sukamaju - Sistem Informasi Desa

Sistem informasi desa untuk Desa Sukamaju yang dibangun dengan Laravel 12 dan Filament. Aplikasi ini menampilkan profil desa, berita, UMKM, produk, peta desa, serta berbagai infografis seperti penduduk, APBDes, stunting, bansos, IDM, dan SDGs.

## Fitur utama

- Halaman profil desa
- Daftar berita dan detail berita per slug
- Katalog UMKM dan detail produk
- Infografis desa berbasis data statistik
- Peta desa berbasis Google Maps
- Panel admin menggunakan Filament
- Struktur backend berbasis Laravel Eloquent Models

## Stack teknologi

- Bahasa utama: PHP
- Framework: Laravel 12
- Template view: Blade
- Admin panel: Filament 3
- Integrasi peta: Filament Google Maps
- Build frontend: Vite + JavaScript

## Struktur proyek

```bash
app/
  Filament/             # Konfigurasi panel admin Filament
  Http/Controllers/     # Controller HTTP aplikasi
  Models/               # Model Eloquent untuk data desa
bootstrap/              # Bootstrapping Laravel
config/                 # Konfigurasi aplikasi dan paket
database/               # Migrasi, seeders, dan database
public/                 # Root publik aplikasi
resources/
  css/                  # Styling frontend
  js/                   # JavaScript frontend
  views/                # File Blade templates
routes/
  web.php               # Route utama aplikasi
storage/                # Cache, log, upload, dll.
tests/                  # Test otomatis
composer.json           # Dependency PHP dan script Composer
package.json            # Dependency frontend dan script NPM
vite.config.js         # Konfigurasi Vite
.env.example            # Contoh konfigurasi environment
phpunit.xml            # Konfigurasi PHPUnit
artisan                 # CLI Laravel
```

## Arsitektur aplikasi

Aplikasi ini mengikuti pola MVC Laravel:

- `routes/web.php` menangani rute publik seperti `/profil`, `/berita`, `/peta-desa`, dan `/infografis/*`
- `app/Http/Controllers` berisi logika pengolahan request dan pengambilan data
- `app/Models` berisi model Eloquent seperti `Berita`, `Produk`, `Umkm`, `Apbdes`, `Demografi`, `Bansos`, `Stunting`, dan lain-lain
- `resources/views` berisi tampilan halaman yang ditampilkan ke pengguna
- `app/Filament` menyediakan panel admin untuk pengelolaan data

## Rute yang tersedia

Beberapa route utama yang terdefinisi di `routes/web.php`:

```text
/                       # landing page bawaan Laravel
/profil                 # halaman profil desa
/berita                 # daftar berita
/berita/{slug}          # detail berita
/belanja-umkm           # halaman UMKM
/produk/{produk:slug}   # detail produk
/infografis             # redirect ke infografis penduduk
/infografis/penduduk   # data penduduk
/infografis/apbdes     # data APBDes
/infografis/stunting   # data stunting
/infografis/bansos     # data bansos
/infografis/idm        # data IDM
/infografis/sdgs       # data SDGs
/peta-desa             # halaman peta desa
```

## Model utama

Model yang teridentifikasi di folder `app/Models` di antaranya:

- `Berita`
- `Produk`
- `Umkm`
- `Apbdes` dan `ApbdesDetail`
- `Demografi` dan `DemografiDetail`
- `Bansos`
- `PenerimaBansos`
- `Idm`
- `Sdg`
- `Stunting`
- `TitikPenting`
- `User`

Model-model ini menjadi dasar untuk data statistik, berita, produk, dan data desa yang ditampilkan pada halaman aplikasi.

## Persyaratan sistem

Sebelum menjalankan project, pastikan komputer Anda sudah memiliki:

- PHP 8.2 atau lebih tinggi
- Composer
- Node.js dan npm
- Database yang didukung Laravel (SQLite, MySQL, PostgreSQL)

## Cara install dan jalankan

### 1. Clone repository

```bash
git clone https://github.com/muisnryn/DesaSukamaju-FIlament.git
cd DesaSukamaju-FIlament
```

### 2. Instal dependensi PHP

```bash
composer install
```

### 3. Konfigurasi environment

```bash
cp .env.example .env
```

Setelah itu, sesuaikan konfigurasi database pada file `.env`, misalnya:

```env
APP_NAME="Desa Sukamaju"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=desa_sukamaju
DB_USERNAME=root
DB_PASSWORD=
```

Atau jika menggunakan SQLite:

```env
DB_CONNECTION=sqlite
DB_DATABASE=/path/to/database/database.sqlite
```

### 4. Generate application key

```bash
php artisan key:generate
```

### 5. Jalankan migrasi database

```bash
php artisan migrate
```

Jalankan seeder untuk membuat akun admin dan mengisi tabel aplikasi dengan data contoh:

```bash
php artisan db:seed
```

Data yang dibuat seeder ditandai sebagai contoh dan bukan data resmi. Ganti atau hapus data tersebut sebelum website digunakan secara publik. Seeder aman dijalankan berulang kali dan tidak menghapus atau menimpa data yang sudah ada.

### 6. Instal dependensi frontend

```bash
npm install
```

### 7. Jalankan server development

```bash
npm run dev
php artisan serve
```

Akses aplikasi di:

```text
http://127.0.0.1:8000
```

## Menjalankan test

```bash
php artisan test
```

## Build produksi

```bash
npm run build
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Catatan penting

- Pastikan file `.env` sudah benar sebelum menjalankan migrasi dan aplikasi.
- Jika project menggunakan storage publik, mungkin perlu menjalankan: `php artisan storage:link`
- Panel admin Filament biasanya diakses melalui route admin sesuai konfigurasi Filament.

## Kontribusi

Pull request dan kontribusi sangat diterima. Pastikan perubahan Anda sudah diuji sebelum dikirim.

## Lisensi

Project ini menggunakan lisensi default Laravel/MIT. Silakan cek file lisensi yang tersedia di repository untuk detail lengkap.

---

Diadaptasi dari struktur repo `DesaSukamaju-FIlament` dan file utama seperti `routes/web.php`, `composer.json`, dan `app/Models`.