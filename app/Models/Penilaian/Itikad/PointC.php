<?php

namespace App\Models\Penilaian\Itikad;

use App\Models\Setting\Period;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointC extends Model
{
    use HasFactory;

    protected $table = 'point_c';

    protected $guarded = ['id'];

    protected $casts = [
        'TotalSkorPengabdian' => 'float',
        'TotalKelebihanSkor' => 'float',
        'NilaiPengabdian' => 'float',
        'NilaiTambahPengabdian' => 'float',
        'NilaiTotalPengabdianKepadaMasyarakat' => 'float',
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
