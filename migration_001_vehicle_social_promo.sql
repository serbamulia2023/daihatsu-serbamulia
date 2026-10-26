-- Migration 001: struktur data kendaraan, sosial media cabang, kontak promo
-- Target: database aktif `serba_mulia_daihatsu` dari serba_mulia_daihatsu.sql
-- PENTING: backup database terlebih dahulu. Jalankan file ini SATU KALI saja.
-- File ini hanya mengubah skema; tidak menghapus atau mengganti data yang sudah ada.

ALTER TABLE branches
    ADD COLUMN facebook_url VARCHAR(500) NULL AFTER whatsapp,
    ADD COLUMN instagram_url VARCHAR(500) NULL AFTER facebook_url,
    ADD COLUMN tiktok_url VARCHAR(500) NULL AFTER instagram_url;

ALTER TABLE promos
    ADD COLUMN contact_whatsapp VARCHAR(40) NULL AFTER branch_id;

-- Slug dipersiapkan untuk URL halaman detail kendaraan dan SEO.
-- Dibiarkan NULL sementara agar data lama tidak diberi slug otomatis yang keliru.
ALTER TABLE cars
    ADD COLUMN slug VARCHAR(160) NULL AFTER name,
    ADD UNIQUE KEY uq_cars_slug (slug);

-- Tipe/varian kendaraan: setiap mobil bisa memiliki banyak varian.
CREATE TABLE IF NOT EXISTS car_variants (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    car_id INT UNSIGNED NOT NULL,
    name VARCHAR(160) NOT NULL,
    transmission VARCHAR(100) NULL,
    price DECIMAL(15,2) NULL,
    description TEXT NULL,
    sort_order INT NOT NULL DEFAULT 0,
    is_active TINYINT(1) NOT NULL DEFAULT 1,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    KEY idx_car_variants_car_active_order (car_id, is_active, sort_order),
    CONSTRAINT fk_car_variants_car
        FOREIGN KEY (car_id) REFERENCES cars (id)
        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Spesifikasi disimpan per varian agar perbedaan antar-tipe tidak tercampur.
CREATE TABLE IF NOT EXISTS car_specifications (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    variant_id INT UNSIGNED NOT NULL,
    spec_group VARCHAR(120) NOT NULL DEFAULT 'Umum',
    spec_name VARCHAR(160) NOT NULL,
    spec_value TEXT NOT NULL,
    sort_order INT NOT NULL DEFAULT 0,
    PRIMARY KEY (id),
    KEY idx_car_specs_variant_group_order (variant_id, spec_group, sort_order),
    CONSTRAINT fk_car_specifications_variant
        FOREIGN KEY (variant_id) REFERENCES car_variants (id)
        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Setiap warna ditautkan ke varian yang memang menawarkan warna tersebut.
-- image_url sebaiknya menunjuk foto resmi kendaraan dalam warna terkait.
CREATE TABLE IF NOT EXISTS car_colors (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    variant_id INT UNSIGNED NOT NULL,
    name VARCHAR(100) NOT NULL,
    color_code VARCHAR(20) NULL,
    image_url VARCHAR(500) NOT NULL,
    sort_order INT NOT NULL DEFAULT 0,
    is_active TINYINT(1) NOT NULL DEFAULT 1,
    PRIMARY KEY (id),
    KEY idx_car_colors_variant_active_order (variant_id, is_active, sort_order),
    CONSTRAINT fk_car_colors_variant
        FOREIGN KEY (variant_id) REFERENCES car_variants (id)
        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Kontak Head Office disimpan di tabel settings yang sudah ada.
-- Nilainya sengaja tidak diisi di migrasi ini. Tambahkan melalui dashboard
-- atau isi setelah alamat email/nomor resmi Head Office dikonfirmasi.
