<?php

namespace App\Models\Penilaian\Itikad;

use App\Models\Setting\Period;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointE extends Model
{
    use HasFactory;

    protected $table = 'point_e';

    protected $guarded = ['id'];

    protected $casts = [
        'SumSkor' => 'float',
        'NilaiUnsurPengabdian' => 'float',
    ];

    /* ================= RELATION ================= */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function period()
    {
        return $this->belongsTo(Period::class);
    }
}
