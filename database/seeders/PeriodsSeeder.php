<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PeriodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $periods = [
            [
                'id' => 1,
                'name' => 'Tahun Periode 2021/2022',
                'start_date' => '2022-08-20',
                'end_date' => '2023-01-28',
                'is_closed' => false, // 0 = false
                'created_at' => Carbon::parse('2023-07-31 10:05:11'),
                'updated_at' => Carbon::parse('2023-09-20 11:21:33'),
            ],
            [
                'id' => 2,
                'name' => 'Tahun Periode 2022/2023',
                'start_date' => '2022-12-24',
                'end_date' => '2024-11-30',
                'is_closed' => false, // 0 = false
                'created_at' => Carbon::parse('2023-07-31 10:07:35'),
                'updated_at' => Carbon::parse('2023-11-30 16:04:21'),
            ],
            [
                'id' => 3,
                'name' => 'Tahun Periode 2023/2024',
                'start_date' => '2023-08-17',
                'end_date' => '2024-12-24',
                'is_closed' => false, // 0 = false
                'created_at' => Carbon::parse('2023-12-11 10:53:51'),
                'updated_at' => Carbon::parse('2025-10-16 18:33:28'),
            ],
            [
                'id' => 4,
                'name' => 'Tahun Periode 2024/2025',
                'start_date' => '2025-09-24',
                'end_date' => '2025-12-06',
                'is_closed' => true, // 1 = true
                'created_at' => Carbon::parse('2025-10-16 18:35:27'),
                'updated_at' => Carbon::parse('2025-12-05 07:48:12'),
            ],
        ];

        foreach ($periods as $period) {
            DB::table('periods')->updateOrInsert(
                ['id' => $period['id']],
                $period
            );
        }

        $this->command->info('Seeder periods berhasil dijalankan!');
        $this->command->info('Total data: ' . count($periods));

        // Tampilkan informasi status
        $activePeriods = DB::table('periods')->where('is_closed', false)->count();
        $this->command->info('Periode aktif: ' . $activePeriods);
        $this->command->info('Periode tidak aktif: ' . (count($periods) - $activePeriods));
    }
}
