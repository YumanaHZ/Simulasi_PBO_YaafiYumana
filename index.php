<?php
require_once 'koneksi/database.php';
require_once 'PendaftaranReguler.php';
require_once 'PendaftaranPrestasi.php';
require_once 'PendaftaranKedinasan.php';

// Ambil data spesifik per jalur
$daftarReguler = PendaftaranReguler::getDaftarReguler($pdo);
$daftarPrestasi = PendaftaranPrestasi::getDaftarPrestasi($pdo);
$daftarKedinasan = PendaftaranKedinasan::getDaftarKedinasan($pdo);

// Hitung statistik untuk grafik
$countReguler = count($daftarReguler);
$countPrestasi = count($daftarPrestasi);
$countKedinasan = count($daftarKedinasan);
$totalData = $countReguler + $countPrestasi + $countKedinasan;

// Tentukan halaman aktif berdasarkan query string 'page'
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem PMB Spesifik</title>
    <!-- Tailwind CSS (menggunakan warna hijau) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Chart.js untuk grafik batang -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100 font-sans flex h-screen overflow-hidden">

    <!-- Sidebar -->
    <aside class="w-64 bg-green-800 text-white flex flex-col justify-between flex-shrink-0">
        <div>
            <div class="p-5 font-bold text-xl border-b border-green-700 tracking-wider">
                PMB JALUR SPESIFIK
            </div>
            <nav class="mt-6">
                <a href="?page=dashboard" class="flex items-center px-6 py-3 text-sm hover:bg-green-700 transition <?php echo $page === 'dashboard' ? 'bg-green-700 font-semibold border-l-4 border-white' : ''; ?>">
                    <span class="mr-3">📊</span> Dashboard
                </a>
                <a href="?page=reguler" class="flex items-center px-6 py-3 text-sm hover:bg-green-700 transition <?php echo $page === 'reguler' ? 'bg-green-700 font-semibold border-l-4 border-white' : ''; ?>">
                    <span class="mr-3">📝</span> Jalur Reguler
                </a>
                <a href="?page=prestasi" class="flex items-center px-6 py-3 text-sm hover:bg-green-700 transition <?php echo $page === 'prestasi' ? 'bg-green-700 font-semibold border-l-4 border-white' : ''; ?>">
                    <span class="mr-3">🏆</span> Jalur Prestasi
                </a>
                <a href="?page=kedinasan" class="flex items-center px-6 py-3 text-sm hover:bg-green-700 transition <?php echo $page === 'kedinasan' ? 'bg-green-700 font-semibold border-l-4 border-white' : ''; ?>">
                    <span class="mr-3">🏛️</span> Jalur Kedinasan
                </a>
            </nav>
        </div>
        <div class="p-4 border-t border-green-700 text-xs text-center text-green-300">
            &copy; 2026 Yaafi Yumana - TRPL 1A
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="flex-1 flex flex-col overflow-y-auto">
        <!-- Header -->
        <header class="bg-white shadow-sm px-8 py-4 flex justify-between items-center border-b border-gray-200">
            <h1 class="text-2xl font-bold text-green-800">
                <?php
                if ($page === 'dashboard') echo "Dashboard & Statistik";
                elseif ($page === 'reguler') echo "Pendaftaran Jalur Reguler";
                elseif ($page === 'prestasi') echo "Pendaftaran Jalur Prestasi";
                elseif ($page === 'kedinasan') echo "Pendaftaran Jalur Kedinasan";
                ?>
            </h1>
            <span class="text-sm font-semibold text-gray-500">Kelas: TRPL 1A</span>
        </header>

        <!-- Content Body -->
        <div class="p-8">

            <?php if ($page === 'dashboard'): ?>
                <!-- Dashboard Info Cards -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-green-600">
                        <div class="text-sm font-semibold text-gray-400 uppercase">Total Pendaftar</div>
                        <div class="text-3xl font-bold text-gray-700 mt-2"><?php echo $totalData; ?></div>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-blue-500">
                        <div class="text-sm font-semibold text-gray-400 uppercase">Jalur Reguler</div>
                        <div class="text-3xl font-bold text-gray-700 mt-2"><?php echo $countReguler; ?></div>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-yellow-500">
                        <div class="text-sm font-semibold text-gray-400 uppercase">Jalur Prestasi</div>
                        <div class="text-3xl font-bold text-gray-700 mt-2"><?php echo $countPrestasi; ?></div>
                    </div>
                    <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-purple-500">
                        <div class="text-sm font-semibold text-gray-400 uppercase">Jalur Kedinasan</div>
                        <div class="text-3xl font-bold text-gray-700 mt-2"><?php echo $countKedinasan; ?></div>
                    </div>
                </div>

                <!-- Grafik Batang -->
                <div class="bg-white p-6 rounded-lg shadow-sm max-w-2xl mx-auto">
                    <h2 class="text-lg font-semibold text-gray-700 mb-4 text-center">Grafik Jumlah Pendaftar per Jalur</h2>
                    <div class="relative" style="height: 300px;">
                        <canvas id="pendaftarChart"></canvas>
                    </div>
                </div>

                <script>
                    const ctx = document.getElementById('pendaftarChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['Reguler', 'Prestasi', 'Kedinasan'],
                            datasets: [{
                                label: 'Jumlah Pendaftar',
                                data: [<?php echo $countReguler; ?>, <?php echo $countPrestasi; ?>, <?php echo $countKedinasan; ?>],
                                backgroundColor: [
                                    'rgba(59, 130, 246, 0.7)',  // Blue
                                    'rgba(234, 179, 8, 0.7)',   // Yellow
                                    'rgba(168, 85, 247, 0.7)'   // Purple
                                ],
                                borderColor: [
                                    'rgb(59, 130, 246)',
                                    'rgb(234, 179, 8)',
                                    'rgb(168, 85, 247)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        stepSize: 1
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    display: false
                                }
                            }
                        }
                    });
                </script>

            <?php elseif ($page === 'reguler'): ?>
                <!-- Tabel Reguler -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-green-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-green-800 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-green-800 uppercase tracking-wider">Nama Calon</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-green-800 uppercase tracking-wider">Asal Sekolah</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-green-800 uppercase tracking-wider">Nilai Ujian</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-green-800 uppercase tracking-wider">Biaya Dasar</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-green-800 uppercase tracking-wider">Pilihan Prodi</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-green-800 uppercase tracking-wider">Lokasi Kampus</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-green-800 uppercase tracking-wider">Informasi Jalur (Polimorfik)</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-green-800 uppercase tracking-wider">Total Biaya (Polimorfik)</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 text-sm text-gray-700">
                                <?php foreach ($daftarReguler as $mhs): ?>
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900"><?php echo $mhs->getIdPendaftaran(); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($mhs->getNamaCalon()); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($mhs->getAsalSekolah()); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?php echo $mhs->getNilaiUjian(); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap">Rp <?php echo number_format($mhs->getBiayaPendaftaranDasar(), 0, ',', '.'); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($mhs->getPilihanProdi()); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($mhs->getLokasiKampus()); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap italic text-green-600"><?php echo htmlspecialchars($mhs->tampilkanInfoJalur()); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap font-bold text-green-700">Rp <?php echo number_format($mhs->hitungTotalBiaya(), 0, ',', '.'); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            <?php elseif ($page === 'prestasi'): ?>
                <!-- Tabel Prestasi -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-green-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-green-800 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-green-800 uppercase tracking-wider">Nama Calon</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-green-800 uppercase tracking-wider">Asal Sekolah</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-green-800 uppercase tracking-wider">Nilai Ujian</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-green-800 uppercase tracking-wider">Biaya Dasar</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-green-800 uppercase tracking-wider">Jenis Prestasi</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-green-800 uppercase tracking-wider">Tingkat Prestasi</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-green-800 uppercase tracking-wider">Informasi Jalur (Polimorfik)</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-green-800 uppercase tracking-wider">Total Biaya (Polimorfik)</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 text-sm text-gray-700">
                                <?php foreach ($daftarPrestasi as $mhs): ?>
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900"><?php echo $mhs->getIdPendaftaran(); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($mhs->getNamaCalon()); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($mhs->getAsalSekolah()); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?php echo $mhs->getNilaiUjian(); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap">Rp <?php echo number_format($mhs->getBiayaPendaftaranDasar(), 0, ',', '.'); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($mhs->getJenisPrestasi()); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($mhs->getTingkatPrestasi()); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap italic text-green-600"><?php echo htmlspecialchars($mhs->tampilkanInfoJalur()); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap font-bold text-green-700">Rp <?php echo number_format($mhs->hitungTotalBiaya(), 0, ',', '.'); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            <?php elseif ($page === 'kedinasan'): ?>
                <!-- Tabel Kedinasan -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-green-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-green-800 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-green-800 uppercase tracking-wider">Nama Calon</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-green-800 uppercase tracking-wider">Asal Sekolah</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-green-800 uppercase tracking-wider">Nilai Ujian</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-green-800 uppercase tracking-wider">Biaya Dasar</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-green-800 uppercase tracking-wider">SK Ikatan Dinas</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-green-800 uppercase tracking-wider">Instansi Sponsor</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-green-800 uppercase tracking-wider">Informasi Jalur (Polimorfik)</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-green-800 uppercase tracking-wider">Total Biaya (Polimorfik)</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 text-sm text-gray-700">
                                <?php foreach ($daftarKedinasan as $mhs): ?>
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900"><?php echo $mhs->getIdPendaftaran(); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($mhs->getNamaCalon()); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($mhs->getAsalSekolah()); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?php echo $mhs->getNilaiUjian(); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap">Rp <?php echo number_format($mhs->getBiayaPendaftaranDasar(), 0, ',', '.'); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($mhs->getSkIkatanDinas()); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($mhs->getInstansiSponsor()); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap italic text-green-600"><?php echo htmlspecialchars($mhs->tampilkanInfoJalur()); ?></td>
                                        <td class="px-6 py-4 whitespace-nowrap font-bold text-green-700">Rp <?php echo number_format($mhs->hitungTotalBiaya(), 0, ',', '.'); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </main>

</body>
</html>