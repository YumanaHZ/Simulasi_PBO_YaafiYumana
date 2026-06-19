<?php
require_once 'Pendaftaran.php';

class PendaftaranReguler extends Pendaftaran {
    protected $pilihanProdi;
    protected $lokasiKampus;

    public function __construct($id_pendaftaran, $nama_calon, $asal_sekolah, $nilai_ujian, $biaya_pendaftaran_dasar, $pilihanProdi, $lokasiKampus) {
        parent::__construct($id_pendaftaran, $nama_calon, $asal_sekolah, $nilai_ujian, $biaya_pendaftaran_dasar);
        $this->pilihanProdi = $pilihanProdi;
        $this->lokasiKampus = $lokasiKampus;
    }

    public static function getDaftarReguler($db) {
        $stmt = $db->query("SELECT * FROM tabel_pendaftaran WHERE jalur_pendaftaran = 'Reguler'");
        $result = [];
        while ($row = $stmt->fetch()) {
            $result[] = new self(
                $row['id_pendaftaran'],
                $row['nama_calon'],
                $row['asal_sekolah'],
                $row['nilai_ujian'],
                $row['biaya_pendaftaran_dasar'],
                $row['pilihan_prodi'],
                $row['lokasi_kampus']
            );
        }
        return $result;
    }

    // Tahap 5: Implementasi Polimorfisme (Polymorphism Overriding)
    // PendaftaranReguler: Total Biaya = biayaPendaftaranDasar
    public function hitungTotalBiaya() {
        return $this->biaya_pendaftaran_dasar;
    }

    public function tampilkanInfoJalur() {
        // Implementasi akan disesuaikan di Tahap 6
        return "Jalur: Reguler, Prodi: " . $this->pilihanProdi . ", Lokasi: " . $this->lokasiKampus;
    }

    // Getters untuk keperluan View
    public function getIdPendaftaran() { return $this->id_pendaftaran; }
    public function getNamaCalon() { return $this->nama_calon; }
    public function getAsalSekolah() { return $this->asal_sekolah; }
    public function getNilaiUjian() { return $this->nilai_ujian; }
    public function getBiayaPendaftaranDasar() { return $this->biaya_pendaftaran_dasar; }
    public function getPilihanProdi() { return $this->pilihanProdi; }
    public function getLokasiKampus() { return $this->lokasiKampus; }
}
?>