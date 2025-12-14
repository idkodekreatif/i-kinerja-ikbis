<?php

namespace App\Models\Setting\Indikator;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomponenPoin extends Model
{
    use HasFactory;

    protected $table = 'komponen_poin';

    protected $fillable = [
        'nama_komponen',
        'non_jad',
        'aa',
        'lektor',
        'lk',
        'gb'
    ];

    // Jika perlu mapping nama kolom yang lebih friendly
    protected $appends = ['nama_jabatan_mapping'];

    public function getNamaJabatanMappingAttribute()
    {
        return [
            'non_jad' => 'Non-JAD',
            'aa' => 'Asisten Ahli',
            'lektor' => 'Lektor',
            'lk' => 'Lektor Kepala',
            'gb' => 'Guru Besar'
        ];
    }

    // Helper untuk mengambil nilai berdasarkan kode jabatan
    public function getPoinByJabatan($kodeJabatan)
    {
        $mapping = [
            'non-jad' => 'non_jad',
            'aa' => 'aa',
            'lektor' => 'lektor',
            'lk' => 'lk',
            'gb' => 'gb'
        ];

        $column = $mapping[$kodeJabatan] ?? $kodeJabatan;
        return $this->{$column} ?? null;
    }
}
