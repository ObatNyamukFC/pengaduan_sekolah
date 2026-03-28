# 📢 Sistem Pengaduan & Aspirasi Sekolah

Aplikasi web berbasis Laravel untuk menyampaikan aspirasi dan pengaduan siswa kepada admin sekolah.

---

## 🔧 Teknologi yang Digunakan

- **PHP** >= 8.2
- **Laravel** 12
- **MySQL** (via Laragon)
- **Tailwind CSS**
- **HeidiSQL** (untuk manajemen database)

---

## ⚙️ Cara Setup di Laptop/PC Masing-Masing

### 1. Persiapan Awal

Pastikan software berikut sudah terinstall:

| Software | Download |
|---|---|
| Laragon | https://laragon.org/download |
| Composer | https://getcomposer.org/download |
| Node.js | https://nodejs.org |
| Git | https://git-scm.com |

---

### 2. Clone Repository

Buka terminal, lalu jalankan:

```bash
cd C:\laragon\www
git clone https://github.com/ObatNyamukFC/pengaduan_sekolah.git
cd pengaduan_sekolah
```

---

### 3. Install Dependencies

```bash
composer install
npm install
```

---

### 4. Setup File .env

Copy file `.env.example` menjadi `.env`:

```bash
cp .env.example .env
```

Lalu buka file `.env` dan sesuaikan bagian database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_pengaduan_sekolah
DB_USERNAME=root
DB_PASSWORD=
```

> Kalau Laragon kamu punya password, isi bagian `DB_PASSWORD`.

---

### 5. Generate App Key

```bash
php artisan key:generate
```

---

### 6. Buat Database

1. Buka **HeidiSQL** atau **phpMyAdmin**
2. Buat database baru dengan nama: `db_pengaduan_sekolah`
3. Import file `db_pengaduan_sekolah.sql` yang ada di root folder project

**Cara import di HeidiSQL:**
- Klik database `db_pengaduan_sekolah`
- Menu **File → Load SQL file**
- Pilih file `db_pengaduan_sekolah.sql`
- Klik **Execute (F9)**

---

### 7. Jalankan Migration

```bash
php artisan migrate
```

---

### 8. Jalankan Aplikasi

Buka **2 terminal** secara bersamaan:

**Terminal 1 — Laravel server:**
```bash
php artisan serve
```

**Terminal 2 — Tailwind CSS:**
```bash
npm run dev
```

---

### 9. Buka di Browser

```
http://127.0.0.1:8000
```

---

## 🔑 Akun Default

### Admin
| Field | Value |
|---|---|
| Username | `admin` |
| Password | `password` |

### Siswa (contoh NIS yang terdaftar)
| NIS | Kelas |
|---|---|
| `5530001` | X RPL 1 |
| `5530002` | XI TKJ 1 |
| `5530003` | XII MM 1 |

---

## 📁 Struktur Project

```
pengaduan_sekolah/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php      # Login & Logout
│   │   │   ├── SiswaController.php     # Fitur siswa
│   │   │   └── AdminController.php     # Fitur admin
│   │   └── Middleware/
│   │       ├── IsAdmin.php             # Guard halaman admin
│   │       └── IsSiswa.php             # Guard halaman siswa
│   └── Models/
│       ├── Admin.php
│       ├── Siswa.php
│       ├── Kategori.php
│       ├── InputAspirasi.php
│       └── Aspirasi.php
├── database/
│   ├── migrations/                     # Struktur tabel
│   └── db_pengaduan_sekolah.sql        # Export database lengkap
├── resources/
│   └── views/
│       ├── login_siswa.blade.php
│       ├── login_admin.blade.php
│       ├── siswa/
│       │   └── aspirasi.blade.php
│       └── admin/
│           └── dashboard.blade.php
└── routes/
    └── web.php
```

---

## 🔄 Alur Aplikasi

```
Siswa login (NIS)
      ↓
Input aspirasi (kategori, lokasi, keterangan, anonim/tidak)
      ↓
Status otomatis: Menunggu
      ↓
Admin login → lihat semua laporan
      ↓
Admin update status (Menunggu → Proses → Selesai) + feedback
      ↓
Siswa bisa lihat status & feedback di histori
```

---

## 🔒 Fitur Keamanan

- Password admin di-hash dengan **Bcrypt**
- Proteksi **CSRF** di semua form
- **Middleware** pemisah akses admin dan siswa
- Login siswa anonim (NIS disembunyikan dari admin)
- Validasi semua input form

---

## ❓ Troubleshooting

**Error: Table sessions doesn't exist**
```bash
php artisan session:table
php artisan migrate
```

**Error: App key not set**
```bash
php artisan key:generate
```

**Tailwind tidak jalan**
```bash
npm install
npm run dev
```

**Error 500 setelah clone**
```bash
composer install
cp .env.example .env
php artisan key:generate
```
