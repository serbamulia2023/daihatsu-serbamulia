MIGRATION 001 - DATA KENDARAAN, SOSIAL MEDIA CABANG, KONTAK PROMO

Target database: serba_mulia_daihatsu
File sumber skema: serba_mulia_daihatsu.sql (database aktif yang dikirim pengguna)

SEBELUM MENJALANKAN
1. Buka phpMyAdmin dan pilih database serba_mulia_daihatsu.
2. Pilih Export dan simpan backup database saat ini.
3. Pastikan backup dapat diunduh dan ukuran file tidak nol.
4. Buka tab Import, pilih migration_001_vehicle_social_promo.sql, lalu jalankan.
5. Jangan jalankan file ini dua kali karena perintah ALTER TABLE menambahkan kolom dan index.

YANG DITAMBAHKAN
- URL Facebook, Instagram, TikTok pada branches.
- Nomor WhatsApp khusus promo pada promos (opsional; fallback ke WhatsApp cabang dilakukan di kode PHP).
- Kolom slug pada cars untuk URL halaman detail kendaraan.
- Tabel car_variants, car_specifications, car_colors.

CATATAN
- Migrasi ini hanya menyiapkan struktur database; belum mengubah PHP/admin atau membuat data varian, spesifikasi, dan warna.
- Kolom cars.slug sengaja NULL agar slug tiap mobil ditetapkan secara sadar sebelum halaman detail dipublikasikan.
- Jangan mengisi spesifikasi/warna berdasarkan perkiraan. Gunakan sumber resmi Daihatsu dan foto yang sesuai dengan tipe serta warna.
- Sebelum implementasi PHP, lakukan uji di salinan database lokal terlebih dahulu.
