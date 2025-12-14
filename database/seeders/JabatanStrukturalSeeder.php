<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\UnitKerja;

class JabatanStrukturalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan unit_kerja sudah di-seed terlebih dahulu
        // Cari mapping unit kerja berdasarkan id
        $unitKerjaMapping = [
            1 => 'Universitas / Institut',
            2 => 'Bidang Akademik dan Kemahasiswaan',
            3 => 'Bidang Umum dan Keuangan',
            4 => 'Fakultas Kesehatan',
            5 => 'Fakultas Bisnis',
            6 => 'Program Studi S1 Akuntansi – Fakultas Bisnis',
            7 => 'Program Studi S1 Manajemen – Fakultas Bisnis',
            8 => 'Program Studi S1 Ilmu Gizi – Fakultas Kesehatan',
            9 => 'Program Studi S1 Keperawatan dan Ners – Fakultas Kesehatan',
            10 => 'Program Studi D3 Kebidanan – Fakultas Kesehatan',
            11 => 'UPT Laboratorium Terpadu',
            12 => 'UPT Perpustakaan',
            13 => 'Lembaga Riset dan Pengembangan (Lemlitbang)',
            14 => 'Lembaga Penjaminan Mutu (LPM)',
            15 => 'Sub-LPPM Fakultas',
            16 => 'Bidang Kemahasiswaan dan Alumni',
            17 => 'UPT Pelaksana Teknis',
            18 => 'UPT Teknologi Informasi',
            19 => 'Biro Administrasi Umum (BAU)',
            20 => 'Biro Administrasi Akademik (BAAK)',
            21 => 'Biro Protokoler, Umum, dan Kepegawaian',
            22 => 'UPT Penerimaan Mahasiswa Baru (PMB)',
            23 => 'Bidang Kerja Sama dan Kemitraan',
            24 => 'UPT Website dan Media Sosial',
        ];

        $jabatanStruktural = [
            // 1. Rektor
            [
                'id' => 1,
                'name' => 'Rektor',
                'sub_koordinator' => 'Institut',
                'unit_kerja_id' => 1, // Universitas / Institut
                'description' => null,
                'created_at' => Carbon::parse('2025-11-13 23:47:55'),
                'updated_at' => Carbon::parse('2025-11-13 23:47:55'),
            ],

            // 2. Wakil Rektor I
            [
                'id' => 2,
                'name' => 'Wakil Rektor I',
                'sub_koordinator' => 'Rektorat',
                'unit_kerja_id' => 1, // Universitas / Institut
                'description' => null,
                'created_at' => Carbon::parse('2025-11-13 23:49:10'),
                'updated_at' => Carbon::parse('2025-11-13 23:49:10'),
            ],

            // 3. Wakil Rektor II
            [
                'id' => 3,
                'name' => 'Wakil Rektor II',
                'sub_koordinator' => 'Rektorat',
                'unit_kerja_id' => 1, // Universitas / Institut
                'description' => null,
                'created_at' => Carbon::parse('2025-11-13 23:49:49'),
                'updated_at' => Carbon::parse('2025-11-13 23:49:49'),
            ],

            // 4. Dekan Fakultas Kesehatan
            [
                'id' => 4,
                'name' => 'Dekan Fakultas Kesehatan',
                'sub_koordinator' => 'Fakultas Kesehatan',
                'unit_kerja_id' => 4, // Fakultas Kesehatan
                'description' => null,
                'created_at' => Carbon::parse('2025-11-13 23:51:03'),
                'updated_at' => Carbon::parse('2025-11-13 23:51:03'),
            ],

            // 5. Dekan Fakultas Bisnis
            [
                'id' => 5,
                'name' => 'Dekan Fakultas Bisnis',
                'sub_koordinator' => 'Fakultas Bisnis',
                'unit_kerja_id' => 5, // Fakultas Bisnis
                'description' => null,
                'created_at' => Carbon::parse('2025-11-13 23:52:09'),
                'updated_at' => Carbon::parse('2025-11-13 23:52:09'),
            ],

            // 6. Ketua Program Studi S1 Akuntansi
            [
                'id' => 6,
                'name' => 'Ketua Program Studi S1 Akuntansi',
                'sub_koordinator' => 'Fakultas Bisnis',
                'unit_kerja_id' => 6, // Program Studi S1 Akuntansi – Fakultas Bisnis
                'description' => null,
                'created_at' => Carbon::parse('2025-11-16 03:09:26'),
                'updated_at' => Carbon::parse('2025-11-20 03:05:45'),
            ],

            // 7. Ketua Program Studi S1 Manajemen
            [
                'id' => 7,
                'name' => 'Ketua Program Studi S1 Manajemen',
                'sub_koordinator' => 'Fakultas Bisnis',
                'unit_kerja_id' => 7, // Program Studi S1 Manajemen – Fakultas Bisnis
                'description' => null,
                'created_at' => Carbon::parse('2025-11-16 03:10:17'),
                'updated_at' => Carbon::parse('2025-11-20 03:07:02'),
            ],

            // 8. Ketua Program Studi S1 Ilmu Gizi
            [
                'id' => 8,
                'name' => 'Ketua Program Studi S1 Ilmu Gizi',
                'sub_koordinator' => 'Fakultas Kesehatan',
                'unit_kerja_id' => 8, // Program Studi S1 Ilmu Gizi – Fakultas Kesehatan
                'description' => null,
                'created_at' => Carbon::parse('2025-11-16 03:11:01'),
                'updated_at' => Carbon::parse('2025-11-20 03:06:01'),
            ],

            // 9. Ketua Program Studi S1 Keperawatan dan Ners
            [
                'id' => 9,
                'name' => 'Ketua Program Studi S1 Keperawatan dan Ners',
                'sub_koordinator' => 'Fakultas Kesehatan',
                'unit_kerja_id' => 9, // Program Studi S1 Keperawatan dan Ners – Fakultas Kesehatan
                'description' => null,
                'created_at' => Carbon::parse('2025-11-16 03:11:45'),
                'updated_at' => Carbon::parse('2025-11-20 03:06:16'),
            ],

            // 10. Ketua Program Studi D3 Kebidanan
            [
                'id' => 10,
                'name' => 'Ketua Program Studi D3 Kebidanan',
                'sub_koordinator' => 'Fakultas Kesehatan',
                'unit_kerja_id' => 10, // Program Studi D3 Kebidanan – Fakultas Kesehatan
                'description' => null,
                'created_at' => Carbon::parse('2025-11-16 03:12:16'),
                'updated_at' => Carbon::parse('2025-11-20 03:05:25'),
            ],

            // 11. Sekretaris Program Studi S1 Akuntansi
            [
                'id' => 11,
                'name' => 'Sekretaris Program Studi S1 Akuntansi',
                'sub_koordinator' => 'Program Studi S1 Akuntansi',
                'unit_kerja_id' => 6, // Program Studi S1 Akuntansi – Fakultas Bisnis
                'description' => null,
                'created_at' => Carbon::parse('2025-11-16 03:13:17'),
                'updated_at' => Carbon::parse('2025-11-16 03:13:17'),
            ],

            // 12. Sekretaris Program Studi S1 Manajemen
            [
                'id' => 12,
                'name' => 'Sekretaris Program Studi S1 Manajemen',
                'sub_koordinator' => 'Program Studi S1 Manajemen',
                'unit_kerja_id' => 7, // Program Studi S1 Manajemen – Fakultas Bisnis
                'description' => null,
                'created_at' => Carbon::parse('2025-11-16 03:14:10'),
                'updated_at' => Carbon::parse('2025-11-16 03:14:10'),
            ],

            // 13. Sekretaris Program Studi S1 Ilmu Gizi
            [
                'id' => 13,
                'name' => 'Sekretaris Program Studi S1 Ilmu Gizi',
                'sub_koordinator' => 'Program Studi S1 Ilmu Gizi',
                'unit_kerja_id' => 8, // Program Studi S1 Ilmu Gizi – Fakultas Kesehatan
                'description' => null,
                'created_at' => Carbon::parse('2025-11-16 03:14:35'),
                'updated_at' => Carbon::parse('2025-11-16 03:14:35'),
            ],

            // 14. Sekretaris Program Studi S1 Ilmu Keperawatan dan Ners
            [
                'id' => 14,
                'name' => 'Sekretaris Program Studi S1 Ilmu Keperawatan dan Ners',
                'sub_koordinator' => 'Program Studi S1 Keperawatan dan Ners',
                'unit_kerja_id' => 9, // Program Studi S1 Keperawatan dan Ners – Fakultas Kesehatan
                'description' => null,
                'created_at' => Carbon::parse('2025-11-16 03:15:18'),
                'updated_at' => Carbon::parse('2025-11-16 03:15:18'),
            ],

            // 15. Sekretaris Program Studi D3 Kebidanan
            [
                'id' => 15,
                'name' => 'Sekretaris Program Studi D3 Kebidanan',
                'sub_koordinator' => 'Program Studi D3 Kebidanan',
                'unit_kerja_id' => 10, // Program Studi D3 Kebidanan – Fakultas Kesehatan
                'description' => null,
                'created_at' => Carbon::parse('2025-11-16 03:15:51'),
                'updated_at' => Carbon::parse('2025-11-16 03:15:51'),
            ],

            // 16. Kepala Laboratorium
            [
                'id' => 16,
                'name' => 'Kepala Laboratorium',
                'sub_koordinator' => 'Unit Pelaksanaan Teknis (UPT)',
                'unit_kerja_id' => 11, // UPT Laboratorium Terpadu
                'description' => null,
                'created_at' => Carbon::parse('2025-11-16 03:16:40'),
                'updated_at' => Carbon::parse('2025-11-16 03:34:45'),
            ],

            // 17. Petugas Laboratorium
            [
                'id' => 17,
                'name' => 'Petugas Laboratorium',
                'sub_koordinator' => 'Unit Pelaksanaan Teknis (UPT)',
                'unit_kerja_id' => 11, // UPT Laboratorium Terpadu
                'description' => null,
                'created_at' => Carbon::parse('2025-11-16 03:17:08'),
                'updated_at' => Carbon::parse('2025-11-16 03:35:51'),
            ],

            // 18. Koordinator Perpustakaan
            [
                'id' => 18,
                'name' => 'Koordinator Perpustakaan',
                'sub_koordinator' => 'Unit Pelaksanaan Teknis (UPT)',
                'unit_kerja_id' => 12, // UPT Perpustakaan
                'description' => null,
                'created_at' => Carbon::parse('2025-11-16 03:18:56'),
                'updated_at' => Carbon::parse('2025-11-16 03:35:17'),
            ],

            // 19. Kepala Riset dan Pengembangan
            [
                'id' => 19,
                'name' => 'Kepala Riset dan Pengembangan',
                'sub_koordinator' => 'Rektorat',
                'unit_kerja_id' => 13, // Lembaga Riset dan Pengembangan (Lemlitbang)
                'description' => null,
                'created_at' => Carbon::parse('2025-11-16 03:19:41'),
                'updated_at' => Carbon::parse('2025-11-16 03:19:41'),
            ],

            // 20. Kepala Lembaga Penjaminan Mutu
            [
                'id' => 20,
                'name' => 'Kepala Lembaga Penjaminan Mutu',
                'sub_koordinator' => 'Rektorat',
                'unit_kerja_id' => 14, // Lembaga Penjaminan Mutu (LPM)
                'description' => null,
                'created_at' => Carbon::parse('2025-11-16 03:20:22'),
                'updated_at' => Carbon::parse('2025-11-16 03:20:22'),
            ],

            // 21. Kepala Sub-Lembaga Penelitian dan Pengabdian Masyarakat
            [
                'id' => 21,
                'name' => 'Kepala Sub-Lembaga Penelitian dan Pengabdian Masyarakat',
                'sub_koordinator' => 'Fakultas',
                'unit_kerja_id' => 15, // Sub-LPPM Fakultas
                'description' => null,
                'created_at' => Carbon::parse('2025-11-16 03:21:00'),
                'updated_at' => Carbon::parse('2025-11-16 03:21:00'),
            ],

            // 22. Koordinator Kemahasiswaan dan Alumni
            [
                'id' => 22,
                'name' => 'Koordinator Kemahasiswaan dan Alumni',
                'sub_koordinator' => 'Wakil Rektor I',
                'unit_kerja_id' => 16, // Bidang Kemahasiswaan dan Alumni
                'description' => null,
                'created_at' => Carbon::parse('2025-11-16 03:21:40'),
                'updated_at' => Carbon::parse('2025-11-16 03:21:40'),
            ],

            // 23. Kepala Unit Pelaksana Teknis
            [
                'id' => 23,
                'name' => 'Kepala Unit Pelaksana Teknis',
                'sub_koordinator' => 'Rektorat',
                'unit_kerja_id' => 17, // UPT Pelaksana Teknis
                'description' => null,
                'created_at' => Carbon::parse('2025-11-16 03:22:23'),
                'updated_at' => Carbon::parse('2025-11-16 03:22:23'),
            ],

            // 24. Kepala Subbagian Teknologi Informasi
            [
                'id' => 24,
                'name' => 'Kepala Subbagian Teknologi Informasi',
                'sub_koordinator' => 'Unit Pelaksanaan Teknis (UPT)',
                'unit_kerja_id' => 18, // UPT Teknologi Informasi
                'description' => null,
                'created_at' => Carbon::parse('2025-11-16 03:22:58'),
                'updated_at' => Carbon::parse('2025-11-16 03:35:02'),
            ],

            // 25. Kepala Subbagian Protokoler, Umum, dan Kepegawaian
            [
                'id' => 25,
                'name' => 'Kepala Subbagian Protokoler, Umum, dan Kepegawaian',
                'sub_koordinator' => 'Biro Administrasi Umum',
                'unit_kerja_id' => 19, // Biro Administrasi Umum (BAU)
                'description' => null,
                'created_at' => Carbon::parse('2025-11-16 03:23:31'),
                'updated_at' => Carbon::parse('2025-11-16 03:23:31'),
            ],

            // 26. Kepala Biro Administrasi Akademik
            [
                'id' => 26,
                'name' => 'Kepala Biro Administrasi Akademik',
                'sub_koordinator' => 'Wakil Rektor I',
                'unit_kerja_id' => 20, // Biro Administrasi Akademik (BAAK)
                'description' => null,
                'created_at' => Carbon::parse('2025-11-16 03:24:14'),
                'updated_at' => Carbon::parse('2025-11-16 03:24:14'),
            ],

            // 27. Staf Biro Administrasi Akademik
            [
                'id' => 27,
                'name' => 'Staf Biro Administrasi Akademik',
                'sub_koordinator' => 'Biro Administrasi Akademik',
                'unit_kerja_id' => 20, // Biro Administrasi Akademik (BAAK)
                'description' => null,
                'created_at' => Carbon::parse('2025-11-16 03:24:58'),
                'updated_at' => Carbon::parse('2025-11-16 03:24:58'),
            ],

            // 28. Kepala Biro Administrasi Umum
            [
                'id' => 28,
                'name' => 'Kepala Biro Administrasi Umum',
                'sub_koordinator' => 'Wakil Rektor II',
                'unit_kerja_id' => 19, // Biro Administrasi Umum (BAU)
                'description' => null,
                'created_at' => Carbon::parse('2025-11-16 03:25:49'),
                'updated_at' => Carbon::parse('2025-11-16 03:25:49'),
            ],

            // 29. Staf Unit Keamanan
            [
                'id' => 29,
                'name' => 'Staf Unit Keamanan',
                'sub_koordinator' => 'Biro Administrasi Umum (BAU)',
                'unit_kerja_id' => 21, // Biro Protokoler, Umum, dan Kepegawaian
                'description' => null,
                'created_at' => Carbon::parse('2025-11-16 03:29:16'),
                'updated_at' => Carbon::parse('2025-11-16 03:29:16'),
            ],

            // 30. Staf Unit Sarana
            [
                'id' => 30,
                'name' => 'Staf Unit Sarana',
                'sub_koordinator' => 'Biro Administrasi Umum (BAU)',
                'unit_kerja_id' => 21, // Biro Protokoler, Umum, dan Kepegawaian
                'description' => null,
                'created_at' => Carbon::parse('2025-11-16 03:29:58'),
                'updated_at' => Carbon::parse('2025-11-16 03:29:58'),
            ],

            // 31. Staf Unit Prasarana
            [
                'id' => 31,
                'name' => 'Staf Unit Prasarana',
                'sub_koordinator' => 'Biro Administrasi Umum (BAU)',
                'unit_kerja_id' => 21, // Biro Protokoler, Umum, dan Kepegawaian
                'description' => null,
                'created_at' => Carbon::parse('2025-11-16 03:30:44'),
                'updated_at' => Carbon::parse('2025-11-16 03:30:44'),
            ],

            // 32. Staf Biro Penerimaan Mahasiswa Baru
            [
                'id' => 32,
                'name' => 'Staf Biro Penerimaan Mahasiswa Baru',
                'sub_koordinator' => 'Unit Pelaksanaan Teknis (UPT)',
                'unit_kerja_id' => 22, // UPT Penerimaan Mahasiswa Baru (PMB)
                'description' => null,
                'created_at' => Carbon::parse('2025-11-16 03:31:34'),
                'updated_at' => Carbon::parse('2025-11-20 03:07:37'),
            ],

            // 33. Staf Khusus Bidang Kerja Sama
            [
                'id' => 33,
                'name' => 'Staf Khusus Bidang Kerja Sama',
                'sub_koordinator' => 'Rektorat',
                'unit_kerja_id' => 23, // Bidang Kerja Sama dan Kemitraan
                'description' => null,
                'created_at' => Carbon::parse('2025-11-16 03:32:09'),
                'updated_at' => Carbon::parse('2025-11-16 03:32:09'),
            ],

            // 34. Staf Unit Kebersihan
            [
                'id' => 34,
                'name' => 'Staf Unit Kebersihan',
                'sub_koordinator' => 'Biro Administrasi Umum (BAU)',
                'unit_kerja_id' => 21, // Biro Protokoler, Umum, dan Kepegawaian
                'description' => null,
                'created_at' => Carbon::parse('2025-11-16 03:32:57'),
                'updated_at' => Carbon::parse('2025-11-16 03:32:57'),
            ],

            // 35. Koordinator Website dan Media Sosial
            [
                'id' => 35,
                'name' => 'Koordinator Website dan Media Sosial',
                'sub_koordinator' => 'Unit Pelaksanaan Teknis (UPT)',
                'unit_kerja_id' => 24, // UPT Website dan Media Sosial
                'description' => null,
                'created_at' => Carbon::parse('2025-11-16 03:33:28'),
                'updated_at' => Carbon::parse('2025-11-16 03:35:33'),
            ],

            // 36. Customer Service
            [
                'id' => 36,
                'name' => 'Customer Service',
                'sub_koordinator' => 'Biro Administrasi dan Umum',
                'unit_kerja_id' => 21, // Biro Protokoler, Umum, dan Kepegawaian
                'description' => null,
                'created_at' => Carbon::parse('2025-11-20 03:34:02'),
                'updated_at' => Carbon::parse('2025-11-20 03:35:07'),
            ],

            // 37. Staf Keuangan
            [
                'id' => 37,
                'name' => 'Staf Keuangan',
                'sub_koordinator' => 'Bidang Umum dan Keuangan',
                'unit_kerja_id' => 19, // Biro Administrasi Umum (BAU)
                'description' => null,
                'created_at' => Carbon::parse('2025-11-20 04:01:00'),
                'updated_at' => Carbon::parse('2025-11-20 04:01:00'),
            ],

            // 38. Ka. Sub Biro Keuangan dan Akuntansi
            [
                'id' => 38,
                'name' => 'Ka. Sub Biro Keuangan dan Akuntansi',
                'sub_koordinator' => 'Biro Administrasi dan Umum',
                'unit_kerja_id' => 3, // Bidang Umum dan Keuangan
                'description' => null,
                'created_at' => Carbon::parse('2025-11-20 04:26:02'),
                'updated_at' => Carbon::parse('2025-11-20 04:26:02'),
            ],
        ];

        foreach ($jabatanStruktural as $jabatan) {
            DB::table('jabatan_struktural')->insert($jabatan);
        }

        $this->command->info('Seeder jabatan_struktural berhasil dijalankan!');
        $this->command->info('Total data: ' . count($jabatanStruktural));
    }
}
