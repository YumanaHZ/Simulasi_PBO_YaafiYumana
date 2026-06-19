<?php
require_once 'Pendaftaran.php';

class PendaftaranPrestasi extends Pendaftaran {
    protected $jenisPrestasi;
    protected $tingkatPrestasi;

    public function __construct($id_pendaftaran, $nama_calon, $asal_sekolah, $nilai_ujian, $biaya_pendaftaran_dasar, $jenisPrestasi, $tingkatPrestasi) {
        parent::__construct($id_pendaftaran, $nama_calon, $asal_sekolah, $nilai_ujian, $biaya_pendaftaran_dasar);
        $this->jenisPrestasi = $jenisPrestasi;
        $this->tingkatPrestasi = $tingkatPrestasi;
    }

    public static function getDaftarPrestasi($db) {
        $stmt = $db->query("SELECT * FROM tabel_pendaftaran WHERE jalur_pendaftaran = 'Prestasi'");
        $result = [];
        while ($row = $stmt->fetch()) {
            $result[] = new self(
                $row['id_pendaftaran'],
                $row['nama_calon'],
                $row['asal_sekolah'],
                $row['nilai_ujian'],
                $row['biaya_pendaftaran_dasar'],
                $row['jenis_prestasi'],
                $row['tingkat_prestasi']
            );
        }
        return $result;
    }

    // Tahap 5: Implementasi Polimorfisme (Polymorphism Overriding)
    // PendaftaranPrestasi: Total Biaya = biayaPendaftaranDasar - 50000
    public function hitungTotalBiaya() {
        return $this->biaya_pendaftaran_dasar - 50000;
    }

    public function tampilkanInfoJalur() {
        // Implementasi akan disesuaikan di Tahap 6
        return "Jalur: Prestasi, Jenis: " . $this->jenisPrestasi . " (" . $this->tingkatPrestasi . ")";
    }

    // Getters untuk keperluan View
    public function getIdPendaftaran() { return $this->id_pendaftaran; }
    public function getNamaCalon() { return $this->nama_calon; }
    public function getAsalSekolah() { return $this->asal_sekolah; }
    public function getNilaiUjian() { return $this->nilai_ujian; }
    public function getBiayaPendaftaranDasar() { return $this->biaya_pendaftaran_dasar; }
    public function getJenisPrestasi() { return $this->jenisPrestasi; }
    public function getTingkatPrestasi() { return $this->tingkatPrestasi; }
}
?>