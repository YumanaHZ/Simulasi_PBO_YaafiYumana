CREATE DATABASE IF NOT EXISTS DB_SIMULASI_PBO_TRPL1A_YaafiYumana;
USE DB_SIMULASI_PBO_TRPL1A_YaafiYumana;

CREATE TABLE IF NOT EXISTS tabel_pendaftaran (
    id_pendaftaran INT AUTO_INCREMENT PRIMARY KEY,
    nama_calon VARCHAR(100) NOT NULL,
    asal_sekolah VARCHAR(100) NOT NULL,
    nilai_ujian DECIMAL(5,2) NOT NULL,
    biaya_pendaftaran_dasar DECIMAL(10,2) NOT NULL,
    jalur_pendaftaran ENUM('Reguler', 'Prestasi', 'Kedinasan') NOT NULL,
    pilihan_prodi VARCHAR(100) DEFAULT NULL,
    lokasi_kampus VARCHAR(100) DEFAULT NULL,
    jenis_prestasi VARCHAR(100) DEFAULT NULL,
    tingkat_prestasi VARCHAR(50) DEFAULT NULL,
    sk_ikatan_dinas VARCHAR(100) DEFAULT NULL,
    instansi_sponsor VARCHAR(100) DEFAULT NULL
);

-- Insert minimal 20 data sampel (minimal 6-7 data per jalur)
INSERT INTO tabel_pendaftaran (
    nama_calon, asal_sekolah, nilai_ujian, biaya_pendaftaran_dasar, jalur_pendaftaran,
    pilihan_prodi, lokasi_kampus, jenis_prestasi, tingkat_prestasi, sk_ikatan_dinas, instansi_sponsor
) VALUES
-- Jalur Reguler (7 data)
('Budi Santoso', 'SMA Negeri 1 Jakarta', 85.50, 150000.00, 'Reguler', 'Teknik Informatika', 'Kampus Utama', NULL, NULL, NULL, NULL),
('Siti Aminah', 'SMA Negeri 3 Bandung', 90.00, 150000.00, 'Reguler', 'Sistem Informasi', 'Kampus Utama', NULL, NULL, NULL, NULL),
('Rian Hidayat', 'SMA Negeri 2 Surabaya', 78.25, 150000.00, 'Reguler', 'Teknik Elektro', 'Kampus B', NULL, NULL, NULL, NULL),
('Dewi Lestari', 'SMA Negeri 5 Yogyakarta', 88.75, 150000.00, 'Reguler', 'Teknik Industri', 'Kampus Utama', NULL, NULL, NULL, NULL),
('Fajar Nugraha', 'SMA Negeri 1 Semarang', 82.00, 150000.00, 'Reguler', 'Teknik Informatika', 'Kampus B', NULL, NULL, NULL, NULL),
('Lani Wijaya', 'SMA Kristen Yusuf', 92.10, 150000.00, 'Reguler', 'Sistem Informasi', 'Kampus Utama', NULL, NULL, NULL, NULL),
('Andi Wijaya', 'SMA Negeri 8 Jakarta', 80.50, 150000.00, 'Reguler', 'Teknik Elektro', 'Kampus B', NULL, NULL, NULL, NULL),

-- Jalur Prestasi (7 data)
('Eko Prasetyo', 'SMA Negeri 1 Solo', 95.00, 150000.00, 'Prestasi', NULL, NULL, 'Olimpiade Matematika', 'Nasional', NULL, NULL),
('Sari Devi', 'SMA Negeri 1 Denpasar', 91.50, 150000.00, 'Prestasi', NULL, NULL, 'Lomba Karya Ilmiah', 'Provinsi', NULL, NULL),
('Gilang Ramadhan', 'SMA Negeri 4 Medan', 89.00, 150000.00, 'Prestasi', NULL, NULL, 'Kejuaraan Bulutangkis', 'Nasional', NULL, NULL),
('Hana Sofia', 'SMA Negeri 2 Malang', 94.20, 150000.00, 'Prestasi', NULL, NULL, 'Lomba Debat Bahasa Inggris', 'Internasional', NULL, NULL),
('Indra Lesmana', 'SMA Negeri 3 Makassar', 87.80, 150000.00, 'Prestasi', NULL, NULL, 'Olimpiade Fisika', 'Provinsi', NULL, NULL),
('Joko Widodo', 'SMA Negeri 1 Surakarta', 90.00, 150000.00, 'Prestasi', NULL, NULL, 'Lomba Catur', 'Nasional', NULL, NULL),
('Kartika Putri', 'SMA Negeri 1 Bogor', 93.50, 150000.00, 'Prestasi', NULL, NULL, 'Festival Seni Tari', 'Nasional', NULL, NULL),

-- Jalur Kedinasan (7 data)
('Lukman Hakim', 'SMA Negeri 1 Padang', 86.00, 200000.00, 'Kedinasan', NULL, NULL, NULL, NULL, 'SK-102/KD/2026', 'Kementerian Perhubungan'),
('Mega Utami', 'SMA Negeri 1 Palembang', 89.50, 200000.00, 'Kedinasan', NULL, NULL, NULL, NULL, 'SK-105/KD/2026', 'Kementerian Keuangan'),
('Naufal Hadi', 'SMA Negeri 2 Balikpapan', 84.00, 200000.00, 'Kedinasan', NULL, NULL, NULL, NULL, 'SK-201/KD/2026', 'Badan Pusat Statistik'),
('Olivia Sendy', 'SMA Negeri 1 Manado', 88.00, 200000.00, 'Kedinasan', NULL, NULL, NULL, NULL, 'SK-304/KD/2026', 'Kementerian Komunikasi dan Informatika'),
('Putra Pratama', 'SMA Negeri 1 Pontianak', 83.50, 200000.00, 'Kedinasan', NULL, NULL, NULL, NULL, 'SK-088/KD/2026', 'Kementerian Dalam Negeri'),
('Qori Aina', 'SMA Negeri 1 Aceh', 91.00, 200000.00, 'Kedinasan', NULL, NULL, NULL, NULL, 'SK-707/KD/2026', 'Badan Siber dan Sandi Negara'),
('Rendy Pangalila', 'SMA Negeri 1 Jayapura', 82.50, 200000.00, 'Kedinasan', NULL, NULL, NULL, NULL, 'SK-112/KD/2026', 'Kementerian Perhubungan');
