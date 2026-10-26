SERBA MULIA AUTO DAIHATSU - PHP + MYSQL (XAMPP)
================================================

FITUR VERSI AWAL
- Beranda responsif sesuai arah prototype.
- Data mobil dan cabang dari MySQL.
- Halaman detail cabang berbasis slug.
- Promo dan artikel.
- Login admin dengan password_hash/password_verify.
- Admin CRUD untuk mobil, cabang, promo, artikel.
- Pengaturan judul dan deskripsi hero.
- Prepared statements, output escaping, session login, dan token CSRF untuk formulir admin.

PERSYARATAN
- XAMPP dengan PHP 8.1+ dan MySQL/MariaDB.
- Apache dan MySQL aktif.
- Browser modern.

INSTALASI
1. Ekstrak folder `serba-mulia-daihatsu` ke:
   C:\xampp\htdocs\serba-mulia-daihatsu

2. Buka XAMPP Control Panel, jalankan Apache dan MySQL.

3. Buka http://localhost/phpmyadmin
   Pilih tab Import, lalu import file database.sql dari folder proyek.
   File ini membuat database `serba_mulia_daihatsu` beserta tabel dan data contoh.

4. Buka config/config.php.
   Default XAMPP:
   DB_HOST = 127.0.0.1
   DB_NAME = serba_mulia_daihatsu
   DB_USER = root
   DB_PASS = ''
   BASE_URL = https://daihatsu.serbamulia.co.id
   Untuk pengembangan lokal, ubah sementara menjadi /serba-mulia-daihatsu
   dan nonaktifkan aturan redirect domain di .htaccess.
   Pastikan Apache mengaktifkan mod_rewrite dan mengizinkan aturan .htaccess.

5. Buka:
   http://localhost/serba-mulia-daihatsu/setup.php
   Buat akun admin. Gunakan password unik minimal 12 karakter.

6. SETELAH BERHASIL MEMBUAT ADMIN, HAPUS FILE setup.php dari folder proyek.

7. Login admin di:
   http://localhost/serba-mulia-daihatsu/admin/login.php

8. Setelah login, buka dashboard dan kelola mobil, cabang, promo, artikel, serta pengaturan beranda.

CATATAN PENTING
- Data cabang Samarinda dari prototype diisi sebagai contoh. Verifikasi alamat sebelum website dipublikasikan.
- Alamat dan kontak cabang lain sengaja dikosongkan karena perlu dikonfirmasi; isi lewat Admin > Kelola Cabang.
- URL gambar dapat menggunakan URL HTTPS yang sudah Anda miliki atau URL file yang Anda upload ke folder assets/images.
- Harga, promo, ketersediaan mobil, dan klaim layanan jangan ditayangkan tanpa konfirmasi cabang.
- Admin panel ini adalah fondasi awal. Sebelum dipakai di internet, gunakan HTTPS, password kuat, backup database, pembatasan akses admin, dan hapus file setup.php.
- Jika upload gambar lokal diperlukan, fitur upload file belum diaktifkan pada versi ini; gunakan URL gambar terlebih dahulu.
- Fitur CRUD admin ini belum memiliki role/permission multi-user, log aktivitas, atau reset password email.

STRUKTUR
index.php                 Beranda
mobil.php                 (dapat ditambahkan pada iterasi berikutnya)
cabang.php                Detail cabang dinamis
promo.php                 Daftar promo
artikel.php               Daftar artikel
detail-artikel.php        Detail artikel
config/config.php         Konfigurasi dan helper
includes/header.php       Header bersama
includes/footer.php       Footer bersama
assets/css/style.css      CSS
assets/js/script.js       JavaScript menu responsif
admin/login.php           Login admin
admin/index.php           Dashboard
admin/manage.php          CRUD konten
admin/settings.php        Pengaturan beranda
database.sql              Struktur dan data awal
setup.php                 Pembuatan akun admin (hapus setelah digunakan)


UPDATE: MENAMPILKAN FOTO DEALER DI BERANDA
1. Jika ini instalasi baru, impor database.sql yang sudah diperbarui.
2. Jika database sudah pernah dibuat sebelumnya, buka phpMyAdmin > pilih database serba_mulia_daihatsu > Import, lalu impor update-foto-cabang.sql. Jalankan file update ini hanya satu kali.
3. Login ke Admin > Kelola Cabang > Edit setiap cabang. Isi kolom “URL foto dealer” dengan URL gambar langsung (misalnya URL berakhiran .jpg, .png, atau .webp), lalu klik Simpan.
4. Gunakan foto asli masing-masing dealer agar informasi cabang akurat. Untuk menghindari gambar rusak, pastikan URL dapat dibuka langsung di browser.
5. Kembali ke beranda dan refresh halaman. Foto tampil di atas nama dan alamat cabang. Jika URL belum diisi, website menampilkan placeholder foto.
