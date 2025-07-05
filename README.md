<div align="center">
  <h1 style="font-size: 3em; font-weight: bold;">Sistem Perpustakaan Digital - Pines</h1>
  <p>
    Sebuah platform perpustakaan digital modern yang dibangun dengan Laravel. Kelola, pinjam, dan jelajahi buku dengan mudah.
  </p>
</div>

---

## 🚀 Fitur Utama

Proyek ini dilengkapi dengan berbagai fitur untuk memenuhi kebutuhan perpustakaan modern, baik dari sisi Admin maupun Mahasiswa.

### Untuk Admin 👨‍💼
-   **📚 Manajemen Buku (CRUD):** Tambah, lihat, edit, dan hapus data buku beserta detailnya seperti judul, penulis, stok, dan sampul.
-   **🗂️ Manajemen Kategori & Penulis:** Mengelola kategori buku dan data penulis secara dinamis.
-   **📊 Dasbor Admin:** Tampilan ringkas statistik perpustakaan, termasuk jumlah buku, pengguna, dan aktivitas peminjaman.
-   **📜 Log Aktivitas:** Memantau aktivitas penting yang terjadi di dalam sistem.
-   **👥 Manajemen Pengguna:** Mengelola akun pengguna, termasuk fitur untuk men-suspend akun.

### Untuk Mahasiswa 🎓
-   **🔍 Katalog Buku:** Menjelajahi koleksi buku dengan fitur pencarian (berdasarkan judul/penulis) dan filter berdasarkan kategori.
-   **🔄 Sistem Peminjaman:** Mahasiswa dapat meminjam buku yang tersedia dan melihat riwayat peminjaman mereka.
-   **❤️ Wishlist:** Menambahkan buku yang diminati ke dalam daftar keinginan pribadi.
-   **⭐ Ulasan & Rating:** Memberikan rating dan ulasan pada buku yang pernah dipinjam untuk membantu pengguna lain.
-   **🏠 Dasbor Mahasiswa:** Halaman personal yang menampilkan buku yang sedang dipinjam, statistik pribadi, dan rekomendasi buku.
-   **👤 Profil Pengguna:** Mengelola informasi profil dan keamanan akun.

---

## 🛠️ Tech Stack

Proyek ini dibangun menggunakan teknologi modern dan andal untuk memastikan performa dan skalabilitas.

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel"/>
  <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP"/>
  <img src="https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL"/>
  <img src="https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind CSS"/>
  <img src="https://img.shields.io/badge/Alpine.js-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=white" alt="Alpine.js"/>
  <img src="https://img.shields.io/badge/Vite-646CFF?style=for-the-badge&logo=vite&logoColor=white" alt="Vite"/>
</p>

---

## ⚙️ Instalasi & Setup

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di lingkungan lokal Anda:

1.  **Clone Repositori**
    ```bash
    git clone https://github.com/Reyy514/perpus-digital.git
    cd perpus-digital
    ```

2.  **Install Dependensi**
    ```bash
    composer install
    npm install
    ```

3.  **Setup Environment**
    Salin file `.env.example` menjadi `.env` dan sesuaikan konfigurasinya, terutama untuk koneksi database.
    ```bash
    cp .env.example .env
    ```
    Buka file `.env` dan atur `DB_DATABASE`, `DB_USERNAME`, dan `DB_PASSWORD`.

4.  **Generate Application Key**
    ```bash
    php artisan key:generate
    ```

5.  **Jalankan Migrasi & Seeder**
    Perintah ini akan membuat semua tabel database dan mengisinya dengan data awal (termasuk akun admin default dan data buku).
    ```bash
    php artisan migrate:fresh --seed
    ```

6.  **Buat Symbolic Link untuk Storage**
    Agar file yang diunggah (seperti sampul buku) dapat diakses secara publik.
    ```bash
    php artisan storage:link
    ```

7.  **Compile Aset Frontend**
    ```bash
    npm run dev
    ```

8.  **Jalankan Development Server**
    Buka terminal baru dan jalankan perintah ini.
    ```bash
    php artisan serve
    ```
    Aplikasi sekarang dapat diakses di `http://127.0.0.1:8000`.

---

## 👥 Tim Pengembang

Proyek ini dikembangkan dan dikelola oleh tim yang berdedikasi.

| Foto Profil | Nama | NIM | Peran | GitHub |
| :---: | :--- | :---: | :--- | :---: |
| <img src="https://github.com/Reyy514.png?size=100" width="100" alt="Foto profil Anda"> | **Reyfaldi Ilham Nugraha** | `241351075` | Project Lead | [![GitHub](https://img.shields.io/badge/GitHub-181717?style=for-the-badge&logo=github&logoColor=white)](https://github.com/Reyy514) |
| <img src="https://github.com/molip212.png?size=100" width="100" alt="Foto profil Anggota 2"> | **Muhammad Alif** | `241351093` | Fitur Peminjaman Buku | [![GitHub](https://img.shields.io/badge/GitHub-181717?style=for-the-badge&logo=github&logoColor=white)](https://github.com/molip212) |
| <img src="https://github.com/username-anggota-3.png?size=100" width="100" alt="Foto profil Anggota 3"> | **[Nama Anggota 3]** | `[NIM Anggota 3]` | Frontend Dev | [![GitHub](https://img.shields.io/badge/GitHub-181717?style=for-the-badge&logo=github&logoColor=white)](https://github.com/username-anggota-3) |
| <img src="https://github.com/username-anggota-4.png?size=100" width="100" alt="Foto profil Anggota 4"> | **[Nama Anggota 4]** | `[NIM Anggota 4]` | UI/UX & Testing | [![GitHub](https://img.shields.io/badge/GitHub-181717?style=for-the-badge&logo=github&logoColor=white)](https://github.com/username-anggota-4) |

---
<p align="center">
  Terima kasih telah mengunjungi repositori kami!
</p>
