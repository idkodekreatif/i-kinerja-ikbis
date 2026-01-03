<?php

namespace App\Models\Penilaian\Itikad;

use App\Models\Setting\Period;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointA extends Model
{
    use HasFactory;

    protected $table = 'point_a';

    protected $guarded = [];

    /*
    |--------------------------------------------------------------------------
    | Casting (PENTING agar aman saat hitung)
    |--------------------------------------------------------------------------
    */
    protected $casts = [
        'TotalSkorPendidikanPointA' => 'float',
        'TotalKelebihanA11' => 'float',
        'TotalKelebihanA12' => 'float',
        'TotalKelebihanSkor' => 'float',
        'nilaiPendidikandanPengajaran' => 'float',
        'NilaiTambahPendidikanDanPengajaran' => 'float',
        'NilaiTotalPendidikanDanPengajaran' => 'float',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relasi
    |--------------------------------------------------------------------------
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function period()
    {
        return $this->belongsTo(Period::class);
    }
}
