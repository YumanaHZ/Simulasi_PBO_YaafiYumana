<?php
abstract class Pendaftaran {
    protected $id_pendaftaran;
    protected $nama_calon;
    protected $asal_sekolah;
    protected $nilai_ujian;
    protected $biaya_pendaftaran_dasar;

    public function __construct($id_pendaftaran, $nama_calon, $asal_sekolah, $nilai_ujian, $biaya_pendaftaran_dasar) {
        $this->id_pendaftaran = $id_pendaftaran;
        $this->nama_calon = $nama_calon;
        $this->asal_sekolah = $asal_sekolah;
        $this->nilai_ujian = $nilai_ujian;
        $this->biaya_pendaftaran_dasar = $biaya_pendaftaran_dasar;
    }

    abstract public function hitungTotalBiaya();
    abstract public function tampilkanInfoJalur();
}
?>