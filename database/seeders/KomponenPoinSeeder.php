<?php

namespace Database\Seeders;

use App\Models\Setting\Indikator\KomponenPoin;
use Illuminate\Database\Seeder;

class KomponenPoinSeeder extends Seeder
{
    public function run(): void
    {
        // Data tetap sesuai screenshot
        $data = [
            [
                'nama_komponen' => 'Pendidikan',
                'non_jad' => 11.69,
                'aa' => 10.02,
                'lektor' => 8.35,
                'lk' => 6.68,
                'gb' => 5.01,
            ],
            [
                'nama_komponen' => 'Penelitian',
                'non_jad' => 4.26,
                'aa' => 4.59,
                'lektor' => 6.43,
                'lk' => 7.35,
                'gb' => 8.26,
            ],
            [
                'nama_komponen' => 'Pengabdian',
                'non_jad' => 1.20,
                'aa' => 1.92,
                'lektor' => 1.92,
                'lk' => 1.92,
                'gb' => 1.92,
            ],
            [
                'nama_komponen' => 'Penunjang',
                'non_jad' => 2.17,
                'aa' => 1.84,
                'lektor' => 1.84,
                'lk' => 1.84,
                'gb' => 1.84,
            ],
        ];

        foreach ($data as $item) {
            KomponenPoin::updateOrCreate(
                ['nama_komponen' => $item['nama_komponen']],
                $item
            );
        }
    }
}
