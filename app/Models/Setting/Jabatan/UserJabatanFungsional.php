<?php

namespace App\Models\Setting\Jabatan;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserJabatanFungsional extends Model
{
    use HasFactory;

    protected $table = 'user_jabatan_fungsional';

    protected $fillable = [
        'user_id',
        'jabatan_fungsional_id',
        'unit_kerja_id',
        'tmt_mulai',
        'tmt_selesai',
        'status'
    ];

    protected $casts = [
        'tmt_mulai' => 'date',
        'tmt_selesai' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jabatanFungsional()
    {
        return $this->belongsTo(JabatanFungsional::class);
    }

    public function unitKerja()
    {
        return $this->belongsTo(UnitKerja::class);
    }

    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif')->whereNull('tmt_selesai');
    }
}
