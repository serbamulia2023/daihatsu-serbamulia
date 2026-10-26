-- Jalankan satu kali melalui phpMyAdmin jika database lama sudah pernah dibuat.
USE serba_mulia_daihatsu;
ALTER TABLE branches ADD COLUMN image_url VARCHAR(500) NULL AFTER address;
