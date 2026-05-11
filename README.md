# Perpustakaan Digital

Project Uji Kompetensi Keahlian (UKK) 2026
Sistem Perpustakaan Digital berbasis Laravel yang digunakan untuk mengelola proses peminjaman buku, pengembalian, laporan, serta manajemen pengguna dengan sistem multi role.

---

## Tentang Project

Perpustakaan Digital adalah aplikasi berbasis web yang dibuat untuk membantu proses pengelolaan perpustakaan secara digital dan terstruktur.

Sistem ini memiliki beberapa role pengguna yaitu:

* Anggota
* Petugas
* Kepala Perpustakaan

Setiap role memiliki hak akses dan fitur yang berbeda sesuai kebutuhan.

---

## Fitur Utama

### Authentication

* Login
* Register
* Logout
* Middleware Authentication

---

## Role & Hak Akses

### 1. Anggota

Fitur yang dapat digunakan anggota:

* Melihat daftar buku
* Melihat detail buku
* Mengajukan peminjaman buku
* Mengembalikan buku
* Melihat riwayat peminjaman
* Melihat denda
* Mengelola profile
* Melihat pemberitahuan/notifikasi

---

### 2. Petugas

Fitur yang dapat digunakan petugas:

* Dashboard petugas
* Konfirmasi pengajuan buku
* Konfirmasi pengembalian buku
* Mengelola pembayaran denda
* Mengelola aktivitas perpustakaan
* Membuat laporan
* Cetak laporan PDF
* Mengelola buku
* Mengelola profile

---

### 3. Kepala Perpustakaan

Fitur yang dapat digunakan kepala perpustakaan:

* Dashboard kepala perpustakaan
* Melihat daftar transaksi
* Approve / reject laporan
* Mengelola setting sistem
* Mengelola pengguna
* Menambah pengguna
* Menghapus pengguna
* Update data pengguna
* Cetak laporan PDF
* Mengelola buku
* Mengelola profile

---

## Teknologi Yang Digunakan

### Backend

* Laravel
* PHP
* MySQL

### Frontend

* Blade Template
* Tailwind CSS
* JavaScript

### Library & Fitur Tambahan

* Middleware Role Access
* PDF Generator
* Authentication System
* File Upload
* Notification System

---

## Sistem Hak Akses

Project ini menggunakan middleware untuk membatasi akses berdasarkan role pengguna.

Middleware yang digunakan:

* `isAnggota`
* `isPetugas`
* `isKepalaPerpus`
* `is_pengguna_and_kepala_perpus`

---

## Struktur Sistem

Sistem dibagi menjadi beberapa bagian utama:

### Manajemen Buku

Digunakan untuk:

* Menambah buku
* Mengedit buku
* Menghapus buku
* Melihat daftar buku

### Sistem Peminjaman

Digunakan untuk:

* Pengajuan peminjaman
* Konfirmasi peminjaman
* Pengembalian buku
* Perhitungan denda

### Manajemen Pengguna

Digunakan untuk:

* Menambah pengguna
* Mengubah data pengguna
* Menghapus pengguna
* Mengatur role pengguna

### Laporan

Digunakan untuk:

* Membuat laporan
* Approve laporan
* Reject laporan
* Cetak PDF laporan

---

## Tujuan Project

Project ini dibuat sebagai:

* Project UKK 2026
* Media pembelajaran Laravel
* Implementasi sistem multi role
* Simulasi sistem perpustakaan digital modern

---

## Author

Made with ☕ by Argi
