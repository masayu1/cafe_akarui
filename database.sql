CREATE DATABASE IF NOT EXISTS db_cafe_akarui
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE db_cafe_akarui;

CREATE TABLE IF NOT EXISTS pelanggan (
  id_pelanggan INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100) NOT NULL,
  no_whatsapp VARCHAR(20) NOT NULL
);

CREATE TABLE IF NOT EXISTS meja (
  id_meja INT AUTO_INCREMENT PRIMARY KEY,
  nomor_meja VARCHAR(10) NOT NULL UNIQUE,
  kapasitas INT NOT NULL
);

CREATE TABLE IF NOT EXISTS reservasi (
  id_reservasi INT AUTO_INCREMENT PRIMARY KEY,
  kode_booking VARCHAR(20) NOT NULL UNIQUE,
  id_pelanggan INT NOT NULL,
  id_meja INT NOT NULL,
  tanggal DATE NOT NULL,
  jam TIME NOT NULL,
  jumlah_orang INT NOT NULL,
  catatan TEXT,
  status ENUM('Menunggu','Dikonfirmasi','Dibatalkan') NOT NULL DEFAULT 'Menunggu',
  dibuat_pada TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_reservasi_pelanggan FOREIGN KEY (id_pelanggan)
    REFERENCES pelanggan(id_pelanggan),
  CONSTRAINT fk_reservasi_meja FOREIGN KEY (id_meja)
    REFERENCES meja(id_meja),
  INDEX idx_jadwal_meja (id_meja, tanggal, jam, status)
);

CREATE TABLE IF NOT EXISTS admin (
  id_admin INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL
);

INSERT IGNORE INTO meja (id_meja, nomor_meja, kapasitas) VALUES
(1, 'A1', 2), (2, 'A2', 2), (3, 'B1', 4), (4, 'B2', 4), (5, 'C1', 6);
