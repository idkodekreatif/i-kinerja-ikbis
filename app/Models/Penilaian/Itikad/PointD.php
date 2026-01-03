<?php

namespace App\Models\Penilaian\Itikad;

use App\Models\Setting\Period;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointD extends Model
{
    use HasFactory;

    protected $table = 'point_d';

    protected $guarded = ['id'];

    protected $casts = [
        'TotalSkorUnsurPenunjang' => 'float',
        'TotalKelebihanSkor' => 'float',
        'NilaiUnsurPenunjang' => 'float',
        'NilaiTambahUnsurPenunjang' => 'float',
        'ResultSumNilaiTotalUnsurPenunjang' => 'float',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relasi (KONSISTEN)
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
