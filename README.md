# Penilaian Karyawan dengan Metode SAW (Simple Additive Weighting)

## Deskripsi Proyek
Proyek ini adalah aplikasi berbasis web yang digunakan untuk melakukan penilaian karyawan dengan menggunakan metode **Simple Additive Weighting (SAW)**. Tujuan dari aplikasi ini adalah untuk membantu proses pengambilan keputusan secara objektif dalam menentukan karyawan kontrak terbaik yang layak mendapatkan perpanjangan kontrak.  

Aplikasi ini dibangun menggunakan **PHP** dengan pendekatan **Object-Oriented Programming (OOP)** untuk meningkatkan modularitas dan kemudahan pengelolaan kode.

## Fitur
- **Manajemen Kriteria**: CRUD untuk kriteria penilaian beserta bobotnya.
- **Manajemen Karyawan**: CRUD untuk data karyawan.
- **Penilaian Karyawan**: Menghitung nilai akhir karyawan berdasarkan metode SAW.
- **Laporan Penilaian**: Menyediakan laporan hasil penilaian karyawan dalam format PDF.
- **User-friendly Interface**: Tampilan antarmuka sederhana dan mudah digunakan.

## Teknologi yang Digunakan
- **Backend**: PHP (Object-Oriented Programming)
- **Database**: MySQL
- **Frontend**: HTML, CSS, JavaScript (Bootstrap)
- **PDF Generator**: [FPDF Library](http://www.fpdf.org/)

## Installasi
- Rename folder project menjadi penilaian
- Tempatkan folder pada default directory webserver. XAMPP(htdocs) / Laragon(wwww)
- Jalankan Webserver database
- Import file sql ke database dengan nama database 'penilaian_saw'
- login dengan username dan password default 'admin'
