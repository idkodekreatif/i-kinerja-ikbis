<?php

namespace App\Models\Penilaian\Itikad;

use App\Models\Setting\Period;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointB extends Model
{
    use HasFactory;

    protected $table = 'point_b';

    protected $guarded = [];

    protected $casts = [
        'TotalSkorPenelitianPointB' => 'float',
        'TotalKelebihanSkor' => 'float',
        'NilaiPenelitian' => 'float',
        'NilaiTambahPenelitian' => 'float',
        'NilaiTotalPenelitiandanKaryaIlmiah' => 'float',
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
