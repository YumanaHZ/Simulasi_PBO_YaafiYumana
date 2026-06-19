<?php
require_once 'Pendaftaran.php';

class PendaftaranKedinasan extends Pendaftaran {
    protected $skIkatanDinas;
    protected $instansiSponsor;

    public function __construct($id_pendaftaran, $nama_calon, $asal_sekolah, $nilai_ujian, $biaya_pendaftaran_dasar, $skIkatanDinas, $instansiSponsor) {
        parent::__construct($id_pendaftaran, $nama_calon, $asal_sekolah, $nilai_ujian, $biaya_pendaftaran_dasar);
        $this->skIkatanDinas = $skIkatanDinas;
        $this->instansiSponsor = $instansiSponsor;
    }

    public static function getDaftarKedinasan($db) {
        $stmt = $db->query("SELECT * FROM tabel_pendaftaran WHERE jalur_pendaftaran = 'Kedinasan'");
        $result = [];
        while ($row = $stmt->fetch()) {
            $result[] = new self(
                $row['id_pendaftaran'],
                $row['nama_calon'],
                $row['asal_sekolah'],
                $row['nilai_ujian'],
                $row['biaya_pendaftaran_dasar'],
                $row['sk_ikatan_dinas'],
                $row['instansi_sponsor']
            );
        }
        return $result;
    }

    // Tahap 5: Implementasi Polimorfisme (Polymorphism Overriding)
    // PendaftaranKedinasan: Total Biaya = biayaPendaftaranDasar * 1.25
    public function hitungTotalBiaya() {
        return $this->biaya_pendaftaran_dasar * 1.25;
    }

    public function tampilkanInfoJalur() {
        // Implementasi akan disesuaikan di Tahap 6
        return "Jalur: Kedinasan, SK: " . $this->skIkatanDinas . ", Sponsor: " . $this->instansiSponsor;
    }

    // Getters untuk keperluan View
    public function getIdPendaftaran() { return $this->id_pendaftaran; }
    public function getNamaCalon() { return $this->nama_calon; }
    public function getAsalSekolah() { return $this->asal_sekolah; }
    public function getNilaiUjian() { return $this->nilai_ujian; }
    public function getBiayaPendaftaranDasar() { return $this->biaya_pendaftaran_dasar; }
    public function getSkIkatanDinas() { return $this->skIkatanDinas; }
    public function getInstansiSponsor() { return $this->instansiSponsor; }
}
?>