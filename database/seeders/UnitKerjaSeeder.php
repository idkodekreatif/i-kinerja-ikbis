<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UnitKerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $unitKerja = [
            // UNIVERSITAS / INSTITUT
            [
                'name' => 'Universitas / Institut',
                'type' => 'Akademik',
                'description' => 'Pimpinan tertinggi universitas',
                'created_at' => Carbon::parse('2025-11-13 23:42:23'),
                'updated_at' => Carbon::parse('2025-11-13 23:42:23'),
            ],

            // BIDANG AKADEMIK DAN KEMAHASISWAAN
            [
                'name' => 'Bidang Akademik dan Kemahasiswaan',
                'type' => 'Akademik',
                'description' => 'Bertanggung jawab atas kegiatan akademik dan kemahasiswaan',
                'created_at' => Carbon::parse('2025-11-13 23:43:27'),
                'updated_at' => Carbon::parse('2025-11-13 23:43:27'),
            ],

            // BIDANG UMUM DAN KEUANGAN
            [
                'name' => 'Bidang Umum dan Keuangan',
                'type' => 'Non-akademik',
                'description' => 'Bertanggung jawab atas administrasi umum dan keuangan',
                'created_at' => Carbon::parse('2025-11-13 23:44:09'),
                'updated_at' => Carbon::parse('2025-11-13 23:44:09'),
            ],

            // FAKULTAS KESEHATAN
            [
                'name' => 'Fakultas Kesehatan',
                'type' => 'Akademik',
                'description' => 'Fakultas yang menaungi program studi bidang kesehatan',
                'created_at' => Carbon::parse('2025-11-13 23:45:03'),
                'updated_at' => Carbon::parse('2025-11-13 23:45:03'),
            ],

            // FAKULTAS BISNIS
            [
                'name' => 'Fakultas Bisnis',
                'type' => 'Akademik',
                'description' => 'Fakultas yang menaungi program studi bidang bisnis',
                'created_at' => Carbon::parse('2025-11-13 23:46:04'),
                'updated_at' => Carbon::parse('2025-11-13 23:46:04'),
            ],

            // PROGRAM STUDI S1 AKUNTANSI
            [
                'name' => 'Program Studi S1 Akuntansi – Fakultas Bisnis',
                'type' => 'Akademik',
                'description' => 'Program studi akuntansi jenjang S1 di bawah Fakultas Bisnis',
                'created_at' => Carbon::parse('2025-11-16 02:57:09'),
                'updated_at' => Carbon::parse('2025-11-16 02:57:09'),
            ],

            // PROGRAM STUDI S1 MANAJEMEN
            [
                'name' => 'Program Studi S1 Manajemen – Fakultas Bisnis',
                'type' => 'Akademik',
                'description' => 'Program studi manajemen jenjang S1 di bawah Fakultas Bisnis',
                'created_at' => Carbon::parse('2025-11-16 02:57:33'),
                'updated_at' => Carbon::parse('2025-11-16 02:57:33'),
            ],

            // PROGRAM STUDI S1 ILMU GIZI
            [
                'name' => 'Program Studi S1 Ilmu Gizi – Fakultas Kesehatan',
                'type' => 'Akademik',
                'description' => 'Program studi ilmu gizi jenjang S1 di bawah Fakultas Kesehatan',
                'created_at' => Carbon::parse('2025-11-16 02:58:19'),
                'updated_at' => Carbon::parse('2025-11-16 02:58:19'),
            ],

            // PROGRAM STUDI S1 KEPERAWATAN DAN NERS
            [
                'name' => 'Program Studi S1 Keperawatan dan Ners – Fakultas Kesehatan',
                'type' => 'Akademik',
                'description' => 'Program studi keperawatan jenjang S1 di bawah Fakultas Kesehatan',
                'created_at' => Carbon::parse('2025-11-16 02:58:46'),
                'updated_at' => Carbon::parse('2025-11-16 02:58:46'),
            ],

            // PROGRAM STUDI D3 KEBIDANAN
            [
                'name' => 'Program Studi D3 Kebidanan – Fakultas Kesehatan',
                'type' => 'Akademik',
                'description' => 'Program studi kebidanan jenjang D3 di bawah Fakultas Kesehatan',
                'created_at' => Carbon::parse('2025-11-16 02:59:06'),
                'updated_at' => Carbon::parse('2025-11-16 02:59:06'),
            ],

            // UPT LABORATORIUM TERPADU
            [
                'name' => 'UPT Laboratorium Terpadu',
                'type' => 'Non-akademik',
                'description' => 'Unit Pelaksana Teknis Laboratorium Terpadu',
                'created_at' => Carbon::parse('2025-11-16 03:00:23'),
                'updated_at' => Carbon::parse('2025-11-16 03:00:23'),
            ],

            // UPT PERPUSTAKAAN
            [
                'name' => 'UPT Perpustakaan',
                'type' => 'Non-akademik',
                'description' => 'Unit Pelaksana Teknis Perpustakaan',
                'created_at' => Carbon::parse('2025-11-16 03:01:03'),
                'updated_at' => Carbon::parse('2025-11-16 03:01:03'),
            ],

            // LEMBAGA RISET DAN PENGEMBANGAN
            [
                'name' => 'Lembaga Riset dan Pengembangan (Lemlitbang)',
                'type' => 'Akademik',
                'description' => 'Lembaga yang bertanggung jawab atas riset dan pengembangan',
                'created_at' => Carbon::parse('2025-11-16 03:01:31'),
                'updated_at' => Carbon::parse('2025-11-16 03:01:31'),
            ],

            // LEMBAGA PENJAMINAN MUTU
            [
                'name' => 'Lembaga Penjaminan Mutu (LPM)',
                'type' => 'Akademik',
                'description' => 'Lembaga yang bertanggung jawab atas penjaminan mutu akademik',
                'created_at' => Carbon::parse('2025-11-16 03:02:14'),
                'updated_at' => Carbon::parse('2025-11-16 03:02:14'),
            ],

            // SUB-LPPM FAKULTAS
            [
                'name' => 'Sub-LPPM Fakultas',
                'type' => 'Akademik',
                'description' => 'Sub Lembaga Penelitian dan Pengabdian Masyarakat Fakultas',
                'created_at' => Carbon::parse('2025-11-16 03:02:47'),
                'updated_at' => Carbon::parse('2025-11-16 03:02:47'),
            ],

            // BIDANG KEMAHASISWAAN DAN ALUMNI
            [
                'name' => 'Bidang Kemahasiswaan dan Alumni',
                'type' => 'Akademik',
                'description' => 'Bertanggung jawab atas kegiatan kemahasiswaan dan hubungan alumni',
                'created_at' => Carbon::parse('2025-11-16 03:03:10'),
                'updated_at' => Carbon::parse('2025-11-16 03:03:10'),
            ],

            // UPT PELAKSANA TEKNIS
            [
                'name' => 'UPT Pelaksana Teknis',
                'type' => 'Non-akademik',
                'description' => 'Unit Pelaksana Teknis operasional',
                'created_at' => Carbon::parse('2025-11-16 03:03:27'),
                'updated_at' => Carbon::parse('2025-11-16 03:03:27'),
            ],

            // UPT TEKNOLOGI INFORMASI
            [
                'name' => 'UPT Teknologi Informasi',
                'type' => 'Non-akademik',
                'description' => 'Unit Pelaksana Teknis Teknologi Informasi',
                'created_at' => Carbon::parse('2025-11-16 03:03:50'),
                'updated_at' => Carbon::parse('2025-11-16 03:03:50'),
            ],

            // BIRO ADMINISTRASI UMUM
            [
                'name' => 'Biro Administrasi Umum (BAU)',
                'type' => 'Non-akademik',
                'description' => 'Biro yang menangani administrasi umum',
                'created_at' => Carbon::parse('2025-11-16 03:04:14'),
                'updated_at' => Carbon::parse('2025-11-16 03:04:14'),
            ],

            // BIRO ADMINISTRASI AKADEMIK
            [
                'name' => 'Biro Administrasi Akademik (BAAK)',
                'type' => 'Akademik',
                'description' => 'Biro yang menangani administrasi akademik',
                'created_at' => Carbon::parse('2025-11-16 03:04:46'),
                'updated_at' => Carbon::parse('2025-11-16 03:04:46'),
            ],

            // BIRO PROTOKOLER, UMUM, DAN KEPEGAWAIAN
            [
                'name' => 'Biro Protokoler, Umum, dan Kepegawaian',
                'type' => 'Non-akademik',
                'description' => 'Biro yang menangani protokoler, umum, dan kepegawaian',
                'created_at' => Carbon::parse('2025-11-16 03:05:24'),
                'updated_at' => Carbon::parse('2025-11-16 03:05:24'),
            ],

            // UPT PENERIMAAN MAHASISWA BARU
            [
                'name' => 'UPT Penerimaan Mahasiswa Baru (PMB)',
                'type' => 'Akademik',
                'description' => 'Unit Pelaksana Teknis Penerimaan Mahasiswa Baru',
                'created_at' => Carbon::parse('2025-11-16 03:06:07'),
                'updated_at' => Carbon::parse('2025-11-16 03:06:07'),
            ],

            // BIDANG KERJA SAMA DAN KEMITRAAN
            [
                'name' => 'Bidang Kerja Sama dan Kemitraan',
                'type' => 'Non-akademik',
                'description' => 'Bertanggung jawab atas kerja sama dan kemitraan',
                'created_at' => Carbon::parse('2025-11-16 03:06:28'),
                'updated_at' => Carbon::parse('2025-11-16 03:06:28'),
            ],

            // UPT WEBSITE DAN MEDIA SOSIAL
            [
                'name' => 'UPT Website dan Media Sosial',
                'type' => 'Non-akademik',
                'description' => 'Unit Pelaksana Teknis Website dan Media Sosial',
                'created_at' => Carbon::parse('2025-11-16 03:07:17'),
                'updated_at' => Carbon::parse('2025-11-16 03:07:17'),
            ],
        ];

        foreach ($unitKerja as $unit) {
            DB::table('unit_kerja')->insert($unit);
        }

        $this->command->info('Seeder unit_kerja berhasil dijalankan!');
        $this->command->info('Total data: ' . count($unitKerja));
    }
}
