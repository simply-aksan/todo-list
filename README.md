# 📝 Todo List Application (Laravel)

Aplikasi pencatatan tugas (*To-Do List*) modern berbasis **Laravel 12**, dirancang dengan antarmuka bertema gelap (*Dark Mode*), animasi halus, serta performa ringan dan cepat.

---

## ✨ Fitur Utama

- **CRUD Tugas Lengkap**:
  - Menambah tugas baru (*Create*).
  - Melihat daftar tugas beserta statistik ringkas (*Read*).
  - Melihat rincian lengkap tugas (*Show*).
  - Mengubah judul & deskripsi tugas (*Edit & Update*).
  - Menghapus tugas dengan konfirmasi aman (*Delete*).
- **Quick Status Toggle**: Centang langsung tugas dari halaman utama untuk mengubah status *Selesai* / *Belum Selesai* tanpa perlu membuka form edit.
- **Ringkasan Real-time**: Menampilkan total tugas, jumlah tugas selesai, dan tugas tertunda.
- **Desain Modern Dark UI**:
  - Menggunakan font *Plus Jakarta Sans / Instrument Sans*.
  - Aksen warna crimson/rose modern dengan efek glassmorphism (`backdrop-blur`).
  - Responsif di layar desktop maupun mobile.
- **Performa Tinggi**:
  - Asset dikompilasi secara lokal via Vite & Tailwind CSS v4 tanpa dependensi CDN runtime eksternal.
  - Waktu muat halaman cepat dan tanpa lag.

---

## 🛠️ Tech Stack

- **Backend**: [Laravel 12](https://laravel.com/) (PHP 8.4+)
- **Database**: SQLite (dapat diganti ke MySQL / PostgreSQL jika diperlukan)
- **Frontend / Styling**: Blade Templating & [Tailwind CSS v4](https://tailwindcss.com/)
- **Build Tool**: [Vite](https://vite.dev/)
- **Local Environment**: [Laravel Herd](https://herd.laravel.com/)

---

## 🚀 Panduan Instalasi Lokal

### 1. Clone Repository
```bash
git clone https://github.com/simply-aksan/todo-list.git
cd todo-list
```

### 2. Install Dependensi PHP
```bash
composer install
```

### 3. Install Dependensi Frontend & Build Assets
```bash
npm install
npm run build
```

### 4. Konfigurasi Environment
Salin file `.env.example` menjadi `.env`:
```bash
cp .env.example .env
```
*(Di Windows PowerShell: `Copy-Item .env.example .env`)*

Lalu buat Application Key:
```bash
php artisan key:generate
```

### 5. Setup Database & Migrasi
Pastikan file database SQLite telah ada atau jalankan migrasi langsung:
```bash
php artisan migrate
```

---

## 🌐 Menjalankan Aplikasi

### Opsi A: Menggunakan Laravel Herd (Rekomendasi)
Jika menggunakan Laravel Herd:
1. Hubungkan direktori proyek:
   ```bash
   herd link
   ```
2. Buka di browser:
   ```
   http://todo-list.test
   ```

### Opsi B: Menggunakan Built-in Artisan Server
```bash
php artisan serve
```
Akses aplikasi melalui `http://127.0.0.1:8000`.

---

## 📁 Struktur Penting Proyek

```plaintext
todo-list/
├── app/
│   ├── Http/Controllers/TodoController.php  # Logika CRUD & Toggle Status
│   └── Models/Todo.php                     # Model Todo (fillable & casting)
├── database/
│   └── migrations/                         # Migrasi tabel todos
├── resources/
│   ├── css/app.css                         # Tailwind CSS styling & tema
│   └── views/
│       ├── layouts/app.blade.php           # Layout utama aplikasi
│       └── todos/                          # Halaman index, create, edit, show
└── routes/
    └── web.php                             # Routing aplikasi
```

---

## 👨‍💻 Kontributor

- **Aksan Zulkarnain** - [simply-aksan](https://github.com/simply-aksan)

---

## 📄 Lisensi

Proyek ini bersifat open-source di bawah lisensi [MIT License](LICENSE).
