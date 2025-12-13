<?php

namespace App\Models\Setting\Jabatan;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserUnitKerja extends Model
{
    use HasFactory;

    protected $table = 'user_unit_kerja';

    protected $fillable = [
        'user_id',
        'unit_kerja_id',
        'tmt_mulai',
        'tmt_selesai',
        'status',
        'sumber'
    ];

    protected $casts = [
        'tmt_mulai' => 'date',
        'tmt_selesai' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function unitKerja()
    {
        return $this->belongsTo(UnitKerja::class, 'unit_kerja_id');
    }

    public function scopeAktif($query)
    {
        return $query->whereNull('tmt_selesai');
    }

    public function getIsActiveAttribute()
    {
        return is_null($this->tmt_selesai);
    }
}
