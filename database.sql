CREATE DATABASE IF NOT EXISTS serba_mulia_daihatsu CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE serba_mulia_daihatsu;

CREATE TABLE IF NOT EXISTS admins (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(120) NOT NULL,
  email VARCHAR(190) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS settings (
  setting_key VARCHAR(100) PRIMARY KEY,
  setting_value TEXT NOT NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS cars (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(120) NOT NULL,
  category VARCHAR(120) NOT NULL DEFAULT '',
  description TEXT NULL,
  image_url VARCHAR(500) NULL,
  contact_url VARCHAR(500) NULL,
  sort_order INT NOT NULL DEFAULT 0,
  is_active TINYINT(1) NOT NULL DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS branches (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(120) NOT NULL,
  slug VARCHAR(140) NOT NULL UNIQUE,
  region VARCHAR(120) NOT NULL DEFAULT '',
  address TEXT NULL,
  image_url VARCHAR(500) NULL,
  description TEXT NULL,
  whatsapp VARCHAR(40) NULL,
  maps_url VARCHAR(500) NULL,
  hours TEXT NULL,
  sort_order INT NOT NULL DEFAULT 0,
  is_active TINYINT(1) NOT NULL DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS promos (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  branch_id INT UNSIGNED NULL,
  title VARCHAR(200) NOT NULL,
  summary TEXT NOT NULL,
  end_date DATE NULL,
  is_active TINYINT(1) NOT NULL DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_promos_branch FOREIGN KEY (branch_id) REFERENCES branches(id) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS articles (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(220) NOT NULL,
  slug VARCHAR(240) NOT NULL UNIQUE,
  category VARCHAR(100) NOT NULL DEFAULT 'Tips Mobil',
  summary TEXT NOT NULL,
  body MEDIUMTEXT NOT NULL,
  image_url VARCHAR(500) NULL,
  is_published TINYINT(1) NOT NULL DEFAULT 0,
  published_at DATETIME NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

INSERT IGNORE INTO settings (setting_key, setting_value) VALUES
('hero_title', 'Temukan Daihatsu yang Pas Buat Kamu.'),
('hero_text', 'Serba Mulia Auto hadir untuk menemani kebutuhan mobilitas Anda, mulai dari pembelian mobil, test drive, service hingga sparepart di berbagai kota.');

INSERT IGNORE INTO cars (name, category, description, sort_order) VALUES
('Daihatsu Ayla','City Car','Pilihan ringkas untuk mobilitas harian.',1),
('Daihatsu Sigra','MPV Keluarga','Pilihan untuk kebutuhan keluarga.',2),
('Daihatsu Xenia','MPV Keluarga','Teman perjalanan bersama keluarga.',3),
('Daihatsu Terios','SUV','SUV untuk aktivitas sehari-hari dan perjalanan.',4),
('Daihatsu Rocky','SUV Compact','SUV compact dengan gaya modern.',5),
('Gran Max','Niaga','Pilihan kendaraan untuk mendukung usaha.',6),
('Daihatsu Luxio','MPV','MPV untuk kebutuhan mobilitas.',7),
('Gran Max Pick Up','Mobil Usaha','Kendaraan niaga untuk berbagai kebutuhan bisnis.',8);

INSERT IGNORE INTO branches (name, slug, region, address, description, sort_order) VALUES
('Samarinda','samarinda','KALIMANTAN TIMUR','Jl. PM Noor No. 8, Samarinda Utara.','Hubungi cabang Samarinda untuk informasi unit, penjualan, dan layanan.',1),
('Balikpapan','balikpapan','KALIMANTAN TIMUR','','Temukan dealer, sales, service, dan sparepart Daihatsu di Balikpapan.',2),
('Paser','paser','KALIMANTAN TIMUR','','Layanan Daihatsu untuk kebutuhan masyarakat Paser dan sekitarnya.',3),
('Jayapura','jayapura','PAPUA','','Dealer Daihatsu untuk kebutuhan mobilitas di Jayapura.',4),
('Sorong','sorong','PAPUA BARAT DAYA','','Temukan pilihan mobil dan layanan Daihatsu di Sorong.',5);

INSERT IGNORE INTO articles (title, slug, category, summary, body, is_published, published_at) VALUES
('Kenapa Mobil Tidak Boleh Terlalu Sering Dijemur?','kenapa-mobil-tidak-boleh-sering-dijemur','Tips Mobil','Kenali dampak paparan panas terhadap mobil dan cara merawatnya.','Paparan sinar matahari dan panas dalam waktu lama dapat memengaruhi kondisi eksterior dan interior mobil. Jika memungkinkan, parkir di tempat teduh, gunakan pelindung kaca yang sesuai, dan bersihkan kendaraan secara berkala. Untuk saran perawatan sesuai kondisi mobil, konsultasikan dengan bengkel.',1,NOW()),
('Kapan Waktu yang Tepat untuk Service Mobil?','kapan-waktu-tepat-service-mobil','Service','Pahami tanda dan jadwal perawatan agar mobil tetap nyaman digunakan.','Ikuti jadwal perawatan pada buku manual kendaraan dan perhatikan indikator di dashboard. Jika muncul suara tidak biasa, getaran, atau perubahan performa, periksakan kendaraan ke bengkel. Jadwal dan kebutuhan pemeriksaan dapat berbeda menurut model serta pemakaian.',1,NOW()),
('Kenali Fitur dan Teknologi di Mobil Daihatsu','kenali-fitur-teknologi-mobil-daihatsu','Ensiklomotive','Penjelasan singkat berbagai fitur yang membantu aktivitas berkendara.','Setiap model dan varian memiliki kelengkapan fitur yang berbeda. Sebelum memilih kendaraan, periksa spesifikasi resmi varian yang diminati dan minta penjelasan dari sales agar fitur yang dipilih sesuai kebutuhan.',1,NOW());
