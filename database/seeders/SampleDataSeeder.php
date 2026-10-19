<?php

namespace Database\Seeders;

use App\Models\Aparatur;
use App\Models\Apbdes;
use App\Models\ApbdesDetail;
use App\Models\Bansos;
use App\Models\Berita;
use App\Models\Demografi;
use App\Models\DemografiDetail;
use App\Models\Idm;
use App\Models\PenerimaBansos;
use App\Models\Produk;
use App\Models\ProfilDesa;
use App\Models\Sdg;
use App\Models\Stunting;
use App\Models\TitikPenting;
use App\Models\Umkm;
use Illuminate\Database\Seeder;

class SampleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currentYear = (int) date('Y');
        $years = [$currentYear - 2, $currentYear - 1, $currentYear];

        ProfilDesa::query()->firstOrCreate([], [
            'sejarah' => 'Data contoh. Ganti dengan sejarah resmi Desa Sukamaju sebelum website dipublikasikan.',
            'visi' => 'Data contoh: mewujudkan desa yang maju, mandiri, dan sejahtera.',
            'misi' => "Data contoh:\n1. Meningkatkan pelayanan kepada masyarakat.\n2. Mengembangkan potensi desa secara berkelanjutan.",
            'iframe_peta' => null,
            'deskripsi_wilayah' => 'Data contoh. Silakan isi dengan deskripsi wilayah berdasarkan data resmi desa.',
        ]);

        foreach ([
            ['nama' => 'Contoh Aparatur 1', 'jabatan' => 'Kepala Desa', 'urutan' => 1],
            ['nama' => 'Contoh Aparatur 2', 'jabatan' => 'Sekretaris Desa', 'urutan' => 2],
            ['nama' => 'Contoh Aparatur 3', 'jabatan' => 'Kaur Pemerintahan', 'urutan' => 3],
            ['nama' => 'Contoh Aparatur 4', 'jabatan' => 'Kaur Kesejahteraan', 'urutan' => 4],
        ] as $aparatur) {
            Aparatur::query()->firstOrCreate(
                ['nama' => $aparatur['nama'], 'jabatan' => $aparatur['jabatan']],
                ['urutan' => $aparatur['urutan']]
            );
        }

        foreach ([
            [
                'judul' => '[DATA CONTOH] Kegiatan gotong royong warga',
                'slug' => 'contoh-kegiatan-gotong-royong',
                'isi' => 'Ini adalah berita contoh untuk mengisi tampilan website. Ganti dengan berita dan dokumentasi resmi desa.',
            ],
            [
                'judul' => '[DATA CONTOH] Pelayanan administrasi desa',
                'slug' => 'contoh-pelayanan-administrasi-desa',
                'isi' => 'Ini adalah berita contoh. Sesuaikan isi, tanggal, dan dokumentasi dengan informasi resmi desa.',
            ],
            [
                'judul' => '[DATA CONTOH] Pengembangan produk UMKM',
                'slug' => 'contoh-pengembangan-produk-umkm',
                'isi' => 'Ini adalah berita contoh tentang UMKM. Ganti dengan berita yang telah diverifikasi sebelum dipublikasikan.',
            ],
        ] as $berita) {
            Berita::query()->firstOrCreate(
                ['slug' => $berita['slug']],
                [
                    'judul' => $berita['judul'],
                    'gambar' => null,
                    'isi' => $berita['isi'],
                    'status' => 'published',
                ]
            );
        }

        $umkm = Umkm::query()->firstOrCreate(
            ['nama_umkm' => '[CONTOH] UMKM Sukamaju'],
            [
                'nama_pemilik' => 'Pemilik Contoh',
                'nomor_whatsapp' => '620000000000',
                'deskripsi_singkat' => 'Data contoh UMKM. Ganti nama, kontak, dan deskripsi dengan informasi pemilik yang telah menyetujui publikasi.',
                'gambar_umkm' => null,
            ]
        );

        foreach ([
            [
                'nama_produk' => '[CONTOH] Keripik Singkong',
                'slug' => 'contoh-keripik-singkong',
                'deskripsi' => 'Produk contoh. Ganti deskripsi dan harga dengan informasi dari pelaku UMKM.',
                'harga' => 15000,
                'kategori' => 'Makanan',
            ],
            [
                'nama_produk' => '[CONTOH] Anyaman Bambu',
                'slug' => 'contoh-anyaman-bambu',
                'deskripsi' => 'Produk contoh. Ganti deskripsi dan harga dengan informasi dari pelaku UMKM.',
                'harga' => 50000,
                'kategori' => 'Kerajinan',
            ],
        ] as $produk) {
            Produk::query()->firstOrCreate(
                ['slug' => $produk['slug']],
                [
                    'umkm_id' => $umkm->id,
                    'nama_produk' => $produk['nama_produk'],
                    'deskripsi' => $produk['deskripsi'],
                    'harga' => $produk['harga'],
                    'gambar_produk' => null,
                    'kategori' => $produk['kategori'],
                ]
            );
        }

        $demografiByYear = [
            $years[0] => [1000, 300, 510, 490],
            $years[1] => [1015, 305, 517, 498],
            $years[2] => [1030, 310, 525, 505],
        ];

        foreach ($demografiByYear as $year => [$penduduk, $kepalaKeluarga, $lakiLaki, $perempuan]) {
            Demografi::query()->firstOrCreate(
                ['tahun' => $year],
                [
                    'total_penduduk' => $penduduk,
                    'total_kepala_keluarga' => $kepalaKeluarga,
                    'total_laki_laki' => $lakiLaki,
                    'total_perempuan' => $perempuan,
                ]
            );

            foreach ([
                ['tipe' => 'umur', 'kategori' => '0-17 tahun', 'jumlah' => (int) ($penduduk * 0.28)],
                ['tipe' => 'umur', 'kategori' => '18-59 tahun', 'jumlah' => (int) ($penduduk * 0.58)],
                ['tipe' => 'umur', 'kategori' => '60 tahun ke atas', 'jumlah' => $penduduk - (int) ($penduduk * 0.28) - (int) ($penduduk * 0.58)],
                ['tipe' => 'pendidikan', 'kategori' => 'SD/MI', 'jumlah' => (int) ($penduduk * 0.35)],
                ['tipe' => 'pendidikan', 'kategori' => 'SMP/MTs', 'jumlah' => (int) ($penduduk * 0.25)],
                ['tipe' => 'pendidikan', 'kategori' => 'SMA/SMK ke atas', 'jumlah' => (int) ($penduduk * 0.20)],
                ['tipe' => 'pekerjaan', 'kategori' => 'Petani (contoh)', 'jumlah' => (int) ($penduduk * 0.30)],
                ['tipe' => 'pekerjaan', 'kategori' => 'Wiraswasta (contoh)', 'jumlah' => (int) ($penduduk * 0.20)],
                ['tipe' => 'pekerjaan', 'kategori' => 'Pekerjaan lainnya (contoh)', 'jumlah' => (int) ($penduduk * 0.25)],
                ['tipe' => 'agama', 'kategori' => 'Data agregat contoh', 'jumlah' => $penduduk],
                ['tipe' => 'perkawinan', 'kategori' => 'Data agregat contoh', 'jumlah' => $penduduk],
                ['tipe' => 'dusun', 'kategori' => 'Data wilayah contoh', 'jumlah' => $penduduk],
            ] as $detail) {
                DemografiDetail::query()->firstOrCreate(
                    [
                        'tahun' => $year,
                        'tipe' => $detail['tipe'],
                        'kategori' => $detail['kategori'],
                    ],
                    ['jumlah' => $detail['jumlah']]
                );
            }
        }

        $apbdesAmounts = [
            $years[0] => [800000000, 700000000, 100000000],
            $years[1] => [850000000, 750000000, 100000000],
            $years[2] => [900000000, 800000000, 100000000],
        ];

        foreach ($apbdesAmounts as $year => [$pendapatan, $belanja, $pembiayaan]) {
            $apbdes = Apbdes::query()->firstOrCreate(
                ['tahun' => $year],
                [
                    'total_pendapatan' => $pendapatan,
                    'total_belanja' => $belanja,
                    'total_pembiayaan' => $pembiayaan,
                ]
            );

            foreach ([
                ['tipe' => 'pendapatan', 'kategori' => 'Dana desa (contoh)', 'jumlah' => (int) ($pendapatan * 0.60)],
                ['tipe' => 'pendapatan', 'kategori' => 'Alokasi dana desa (contoh)', 'jumlah' => (int) ($pendapatan * 0.30)],
                ['tipe' => 'pendapatan', 'kategori' => 'Pendapatan lainnya (contoh)', 'jumlah' => (int) ($pendapatan * 0.10)],
                ['tipe' => 'belanja', 'kategori' => 'Belanja pemerintahan (contoh)', 'jumlah' => (int) ($belanja * 0.40)],
                ['tipe' => 'belanja', 'kategori' => 'Pembangunan desa (contoh)', 'jumlah' => (int) ($belanja * 0.40)],
                ['tipe' => 'belanja', 'kategori' => 'Pemberdayaan masyarakat (contoh)', 'jumlah' => (int) ($belanja * 0.20)],
                ['tipe' => 'pembiayaan', 'kategori' => 'Pembiayaan netto (contoh)', 'jumlah' => $pembiayaan],
            ] as $detail) {
                ApbdesDetail::query()->firstOrCreate(
                    [
                        'apbdes_id' => $apbdes->id,
                        'tipe' => $detail['tipe'],
                        'kategori' => $detail['kategori'],
                    ],
                    ['jumlah' => $detail['jumlah']]
                );
            }
        }

        foreach (array_combine($years, [12, 10, 8]) as $year => $jumlahKasus) {
            Stunting::query()->firstOrCreate(
                ['tahun' => $year],
                ['jumlah_kasus' => $jumlahKasus]
            );
        }

        foreach ($years as $year) {
            foreach ([
                ['jenis_bansos' => 'Program bantuan contoh A', 'jumlah_penerima' => 45],
                ['jenis_bansos' => 'Program bantuan contoh B', 'jumlah_penerima' => 30],
                ['jenis_bansos' => 'Program bantuan contoh C', 'jumlah_penerima' => 20],
            ] as $bantuan) {
                Bansos::query()->firstOrCreate(
                    ['tahun' => $year, 'jenis_bansos' => $bantuan['jenis_bansos']],
                    ['jumlah_penerima' => $bantuan['jumlah_penerima']]
                );
            }
        }

        foreach ([
            ['nik' => '0000000000000001', 'nama' => 'Penerima Contoh 1'],
            ['nik' => '0000000000000002', 'nama' => 'Penerima Contoh 2'],
            ['nik' => '0000000000000003', 'nama' => 'Penerima Contoh 3'],
        ] as $penerima) {
            PenerimaBansos::query()->firstOrCreate(
                ['nik' => $penerima['nik']],
                [
                    'nama' => $penerima['nama'],
                    'alamat' => 'Alamat contoh, bukan alamat penerima sebenarnya.',
                ]
            );
        }

        foreach (array_combine($years, [
            [0.5100, 0.6200, 0.4800, 0.4300, 'Berkembang'],
            [0.5700, 0.6800, 0.5300, 0.5000, 'Berkembang'],
            [0.6200, 0.7300, 0.5800, 0.5500, 'Maju'],
        ]) as $year => [$skor, $iks, $ike, $ikl, $status]) {
            Idm::query()->firstOrCreate(
                ['tahun' => $year],
                [
                    'skor_idm' => $skor,
                    'status_idm' => $status,
                    'skor_iks' => $iks,
                    'skor_ike' => $ike,
                    'skor_ikl' => $ikl,
                    'indikator' => 'Data indikator contoh; ganti dengan hasil pengukuran resmi.',
                ]
            );
        }

        $sdgIndicators = [
            'desa_tanpa_kemiskinan' => 65.0000,
            'desa_tanpa_kelaparan' => 68.0000,
            'desa_sehat_sejahtera' => 72.0000,
            'pendidikan_desa_berkualitas' => 70.0000,
            'keterlibatan_perempuan_desa' => 64.0000,
            'desa_layak_air_bersih' => 75.0000,
            'desa_berenergi_bersih' => 60.0000,
            'pertumbuhan_ekonomi_merata' => 62.0000,
            'infrastruktur_inovasi' => 58.0000,
            'desa_tanpa_kesenjangan' => 63.0000,
            'kawasan_pemukiman_aman' => 71.0000,
            'konsumsi_produksi_sadar_lingkungan' => 55.0000,
            'desa_tanggap_perubahan_iklim' => 52.0000,
            'desa_peduli_lingkungan_laut' => 50.0000,
            'desa_peduli_lingkungan_darat' => 67.0000,
            'desa_damai_berkeadilan' => 73.0000,
            'kemitraan_pembangunan_desa' => 61.0000,
            'kelembagaan_desa_dinamis' => 69.0000,
        ];

        foreach (array_combine($years, [62.0000, 65.0000, 67.0000]) as $year => $score) {
            Sdg::query()->firstOrCreate(
                ['tahun' => $year],
                ['skor_total' => $score] + $sdgIndicators
            );
        }

        foreach ([
            ['nama' => '[CONTOH] Kantor Desa', 'kategori' => 'Pemerintahan', 'latitude' => '-6.000000', 'longitude' => '106.000000'],
            ['nama' => '[CONTOH] Fasilitas Ibadah', 'kategori' => 'Ibadah', 'latitude' => '-6.001000', 'longitude' => '106.001000'],
            ['nama' => '[CONTOH] Fasilitas Pendidikan', 'kategori' => 'Pendidikan', 'latitude' => '-6.002000', 'longitude' => '106.002000'],
        ] as $titik) {
            TitikPenting::query()->firstOrCreate(
                ['nama' => $titik['nama']],
                [
                    'kategori' => $titik['kategori'],
                    'deskripsi' => 'Titik dan koordinat ilustrasi, bukan lokasi sebenarnya. Ganti dengan data yang telah diverifikasi.',
                    'foto' => null,
                    'latitude' => $titik['latitude'],
                    'longitude' => $titik['longitude'],
                ]
            );
        }
    }
}
