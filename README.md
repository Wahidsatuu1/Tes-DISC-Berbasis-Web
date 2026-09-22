# Tes DISC Berbasis Web

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)
![Dompdf](https://img.shields.io/badge/dompdf-FFB000?style=for-the-badge&logo=pdf&logoColor=white)

Aplikasi web untuk melakukan tes psikologi DISC berbasis web, yang digunakan untuk mengumpulkan data biodata peserta, menjalankan serangkaian pertanyaan DISC, menghitung dominan kepribadian, dan mengekspor hasilnya ke file PDF.

Project ini dirancang untuk kebutuhan pengujian kepribadian dengan pendekatan digital yang lebih cepat, terstruktur, dan mudah dikelola.

## Preview Project

<p align="center">
  <img src="public/logo.png" alt="Project preview" width="320" />
</p>

## Fitur Utama

- Form biodata peserta sebelum mengikuti tes
- Pengumpulan jawaban DISC dengan skema “most” dan “least”
- Perhitungan skor dan penentuan profil dominan berdasarkan tipe D, I, S, dan C
- Dashboard untuk melihat hasil tes dan statistik keseluruhan
- Pencarian data peserta pada dashboard
- Export hasil tes ke PDF
- Dukungan multi-bahasa sederhana (Indonesia dan Inggris)
- Antarmuka yang responsif dan mudah digunakan

## Teknologi yang Digunakan

- Laravel 13
- PHP 8.3+
- MySQL
- Bootstrap 5
- Dompdf
- Blade Template Engine

## Cara Kerja Aplikasi

### 1. Halaman Landing Page
Pengguna membuka halaman utama untuk memulai tes. Dari sini, mereka bisa masuk ke halaman ujian DISC.

### 2. Pengisian Biodata
Sebelum mengerjakan tes, peserta mengisi data identitas dan informasi pendukung seperti:

- nama lengkap
- nomor identitas
- tanggal lahir
- jenis kelamin
- fakultas / universitas
- alamat
- kontak
- data orang tua / pembimbing

### 3. Proses Tes DISC
Peserta menjawab pertanyaan DISC dengan dua pilihan dalam tiap item:

- pilih jawaban yang paling menggambarkan diri
- pilih jawaban yang paling tidak menggambarkan diri

Sistem akan menghitung skor untuk masing-masing tipe:

- D = Dominance
- I = Influence
- S = Steadiness
- C = Conscientiousness

### 4. Penentuan Profil Dominan
Setelah semua jawaban dikumpulkan, sistem menghitung nilai perubahan (change score) dari tiap tipe. Hasil tersebut digunakan untuk menentukan profil personality dominan peserta.

### 5. Dashboard dan Hasil
Aplikasi menyimpan data hasil tes pada dashboard, yang dapat digunakan untuk melihat:

- daftar hasil tes
- statistik dominan kepribadian
- pencarian dan filter data peserta

### 6. Export PDF
Setiap hasil tes dapat diekspor dalam format PDF agar mudah dibagikan atau dicetak.

## Struktur Project

```text
Tes-DISC-Berbasis-Web/
├── app/
├── bootstrap/
├── config/
├── database/
├── lang/
├── public/
├── resources/
├── routes/
├── storage/
├── tests/
├── .env.example
├── .gitignore
├── artisan
├── composer.json
├── package.json
├── phpunit.xml
├── README.md
├── vite.config.js
└── ...
```

## Persyaratan Sistem

Pastikan komputer Anda sudah memiliki:

- PHP 8.3 atau lebih tinggi
- Composer
- MySQL / MariaDB
- Node.js dan NPM
- Web server seperti Apache atau Laravel Sail

## Instalasi

1. Clone repository:

```bash
git clone https://github.com/Wahidsatuu1/Tes-DISC-Berbasis-Web.git
cd Tes-DISC-Berbasis-Web
```

2. Install dependency PHP:

```bash
composer install
```

3. Install dependency frontend:

```bash
npm install
```

4. Salin file environment:

```bash
cp .env.example .env
```

5. Generate application key:

```bash
php artisan key:generate
```

6. Konfigurasi database di file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tes_disc
DB_USERNAME=root
DB_PASSWORD=
```

7. Jalankan migrasi database:

```bash
php artisan migrate
```

8. Jalankan aplikasi:

```bash
php artisan serve
```

Lalu buka:

```text
http://127.0.0.1:8000
```

## Menjalankan Frontend Asset

Untuk mode development frontend:

```bash
npm run dev
```

Untuk build production:

```bash
npm run build
```

## Penggunaan Aplikasi

1. Buka halaman utama web
2. Klik tombol untuk memulai tes DISC
3. Isi biodata peserta
4. Jawab semua pertanyaan DISC
5. Lihat hasil tes pada dashboard
6. Export hasil ke PDF jika diperlukan

## Kontribusi

Kontribusi sangat terbuka untuk pengembangan lebih lanjut, seperti:

- validasi form yang lebih kuat
- penambahan fitur login admin
- export hasil ke Excel
- visualisasi hasil ke grafik
- keamanan dan autentikasi yang lebih baik

## Lisensi

Project ini dibuat untuk kebutuhan pembelajaran dan pengembangan aplikasi berbasis web. Silakan gunakan dengan bijak sesuai kebutuhan proyek Anda.

---

Dibuat dengan fokus pada pengelolaan tes psikologi DISC secara digital, efisien, dan mudah dipelajari.
