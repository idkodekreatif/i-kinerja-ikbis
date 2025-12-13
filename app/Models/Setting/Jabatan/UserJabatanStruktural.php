<?php

namespace App\Models\Setting\Jabatan;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserJabatanStruktural extends Model
{
    use HasFactory;

    protected $table = 'user_jabatan_struktural';

    protected $fillable = [
        'user_id',
        'jabatan_struktural_id',
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

    public function jabatanStruktural()
    {
        return $this->belongsTo(JabatanStruktural::class);
    }

    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif')->whereNull('tmt_selesai');
    }
}
