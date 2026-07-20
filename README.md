# 🏨 RoomEase — Stay Beautifully

RoomEase adalah aplikasi reservasi hotel berbasis web yang dirancang minimalis, elegan, dan efisien. Aplikasi ini dibangun menggunakan Laravel 13, Blade templating untuk antarmuka pengguna, Tailwind CSS sebagai styling system, dan MySQL sebagai pengelola database lokal (via Laragon).

Project ini didevelop sebagai bagian dari program latihan magang (PKL) di **Desnet** untuk merancang sistem reservasi hotel yang lengkap baik dari sisi tamu (customer-facing) maupun pengelola hotel (admin-facing).

---

## 🚀 Fitur Utama

### 1. 👥 Sisi Tamu (Customer Portal)
* **Explore Stays**: Halaman utama untuk melihat dan memilih tipe kamar yang tersedia lengkap dengan kapasitas, fasilitas tempat tidur, dan rentang harga.
* **Direct Booking Form**: Pemesanan langsung dari kamar yang dipilih dengan verifikasi tanggal (check-in & check-out) dan kalkulasi durasi malam serta total harga secara dinamis.
* **Easy Payment Simulation**: Proses checkout pembayaran instan dengan status tagihan (`unpaid` ke `paid`) dan pilihan metode pembayaran (Cash, Transfer Bank, E-Wallet).
* **Customer Booking Lookup**: Tamu dapat mengecek detail, rincian biaya, dan memantau status reservasi terbarunya cukup dengan memasukkan kode unik pemesanan (`RE-YYYYMMDD-XXXXX`).
* **Download Invoice PDF**: Tamu dapat mengunduh bukti invoice/struk pemesanan digital berformat PDF setelah pembayaran sukses dikonfirmasi.

### 2. 🛡️ Sisi Pengelola (Admin Dashboard)
* **Secure Admin Access**: Proteksi rute admin menggunakan custom middleware dan halaman login admin terpisah.
* **Overview Statistics**: Informasi ringkas mengenai total transaksi pendapatan, status kamar aktif (tersedia/terisi), total reservasi harian, dan ringkasan aktivitas reservasi terbaru.
* **Reservation Lifecycle Management**: Fitur pencarian tamu dan filter status booking. Admin dapat mengubah status reservasi (`pending` -> `confirmed` -> `checked_in` -> `checked_out` -> `cancelled`).
* **Auto-Sync Room Inventory**: Status kamar fisik otomatis tersinkronisasi berdasarkan status reservasi (kamar menjadi `occupied` saat check-in dan kembali `available` saat check-out/batal).
* **Room Management (CRUD)**:
  * Kelola tipe kamar (nama, deskripsi, harga per malam, dan kapasitas tamu).
  * Kelola kamar fisik (nomor kamar, status operasional, dan tipe kategori).

---

## 🛠️ Tech Stack & Library

* **Backend**: PHP 8.5+ & Laravel 13.x
* **Database**: MySQL (via Laragon)
* **Frontend**: Blade Templating & Tailwind CSS
* **Build Tool**: Vite v8.x
* **PDF Library**: DomPDF (`barryvdh/laravel-dompdf`)
* **Version Control**: Git & GitHub

---

## ⚙️ Cara Instalasi & Menjalankan Project

Ikuti langkah-langkah di bawah untuk menjalankan project ini di komputer lokal Anda:

1. **Clone Repository**
   ```bash
   git clone https://github.com/keefalegends/RoomEase.git
   cd RoomEase
   ```

2. **Install Dependensi PHP & JS**
   ```bash
   composer install
   npm install
   ```

3. **Konfigurasi Environment (.env)**
   Salin berkas `.env.example` ke `.env` lalu sesuaikan konfigurasi database Anda (misal: MySQL Laragon):
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=roomease
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. **Jalankan Migrasi & Database Seeder**
   Pastikan MySQL di Laragon Anda sudah aktif, kemudian jalankan:
   ```bash
   php artisan migrate --seed
   ```
   *Perintah di atas akan membuat tabel database dan mengisinya dengan data awal hotel, tipe kamar, kamar fisik, serta akun administrator default.*

5. **Generate Application Key & Build Assets**
   ```bash
   php artisan key:generate
   npm run dev # atau npm run build untuk mode production
   ```

6. **Akses Aplikasi**
   Akses project melalui virtual host Laragon (misal: `http://roomease.test/`) atau gunakan development server bawaan Laravel:
   ```bash
   php artisan serve
   ```
   Aplikasi dapat diakses di `http://127.0.0.1:8000`.

---

## 🔑 Kredensial Akses Admin Default

Gunakan kredensial berikut untuk masuk ke halaman **Admin Management**:
* **URL Login**: `http://roomease.test/admin/login` (atau `http://localhost:8000/admin/login`)
* **Email**: `admin@roomease.test`
* **Password**: `password123`

---

## 📄 Ringkasan Pekerjaan Hari Ini (20 Juli 2026)

Hari ini kita telah berhasil membangun inti sistem reservasi hotel **RoomEase** dari awal hingga siap pakai:
1. **Repository Setup**: Inisiasi repositori git lokal dan sinkronisasi awal dengan repositori remote GitHub (`keefalegends/RoomEase`).
2. **Database & Seeder**: Merancang model dan migrasi terelasi untuk `hotels`, `room_types`, `rooms`, `guests`, `reservations`, `reservation_details`, dan `payments`. Database diisi data hotel awal.
3. **Core Booking Flow**:
   - Menghubungkan formulir pemesanan publik ke database.
   - Mengalokasikan kamar fisik yang tersedia (`available`) secara otomatis.
   - Menghitung durasi malam dan total harga berdasarkan pilihan tanggal.
   - Menyediakan alur simulasi pembayaran (`unpaid` -> `paid`) dan konfirmasi booking.
4. **Admin Dashboard & Management**:
   - Membuat halaman log in administrator aman dan custom middleware pelindung rute.
   - Menyajikan dashboard statistik performa hotel (pendapatan, reservasi, dan ketersediaan kamar).
   - Menyediakan antarmuka CRUD tipe kamar dan kamar fisik hotel.
   - Menyediakan fitur pencarian, filter, dan ubah status reservasi tamu yang terintegrasi dengan status inventori kamar.
5. **Customer Booking Lookup Portal**: Membuka rute pencarian kode booking bagi tamu agar bisa mengecek status reservasi secara mandiri dari halaman depan.
6. **PDF Generation**: Mengintegrasikan `Barryvdh DomPDF` untuk fitur unduh Invoice PDF secara dinamis bagi tamu setelah transaksi pembayaran terkonfirmasi.
