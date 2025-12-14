<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class JabatanFungsionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jabatanFungsional = [
            [
                'id' => 1,
                'name' => 'Asisten Ahli',
                'golongan_min' => 'III/a',
                'golongan_max' => 'III/c',
                'angka_kredit_min' => 150,
                'angka_kredit_next' => 199,
                'description' => 'Jabatan fungsional awal bagi dosen.',
                'created_at' => Carbon::parse('2025-11-13 23:54:03'),
                'updated_at' => Carbon::parse('2025-11-17 03:08:43'),
            ],
            [
                'id' => 2,
                'name' => 'Guru Besar',
                'golongan_min' => 'IV/d',
                'golongan_max' => 'IV/e',
                'angka_kredit_min' => 850,
                'angka_kredit_next' => 0,
                'description' => 'Jabatan fungsional tertinggi bagi dosen.',
                'created_at' => Carbon::parse('2025-11-13 23:54:44'),
                'updated_at' => Carbon::parse('2025-11-17 03:09:33'),
            ],
            [
                'id' => 3,
                'name' => 'Lektor',
                'golongan_min' => 'III/d',
                'golongan_max' => 'IV/a',
                'angka_kredit_min' => 200,
                'angka_kredit_next' => 399,
                'description' => 'Jabatan fungsional setelah Asisten Ahli.',
                'created_at' => Carbon::parse('2025-11-13 23:55:16'),
                'updated_at' => Carbon::parse('2025-11-17 03:10:33'),
            ],
            [
                'id' => 4,
                'name' => 'Lektor Kepala',
                'golongan_min' => 'IV/b',
                'golongan_max' => 'IV/c',
                'angka_kredit_min' => 400,
                'angka_kredit_next' => 849,
                'description' => 'Jabatan fungsional madya tingkat tinggi.',
                'created_at' => Carbon::parse('2025-11-13 23:55:41'),
                'updated_at' => Carbon::parse('2025-11-17 03:11:20'),
            ],
            [
                'id' => 5,
                'name' => 'Non-JAD',
                'golongan_min' => null,
                'golongan_max' => null,
                'angka_kredit_min' => 0,
                'angka_kredit_next' => 149,
                'description' => 'Belum memiliki jabatan fungsional atau bukan jabatan fungsional dosen.',
                'created_at' => Carbon::parse('2025-11-13 23:56:22'),
                'updated_at' => Carbon::parse('2025-11-17 03:11:53'),
            ],
        ];

        foreach ($jabatanFungsional as $jabatan) {
            DB::table('jabatan_fungsional')->insert($jabatan);
        }

        $this->command->info('Seeder jabatan_fungsional berhasil dijalankan!');
        $this->command->info('Total data: ' . count($jabatanFungsional));
    }
}
