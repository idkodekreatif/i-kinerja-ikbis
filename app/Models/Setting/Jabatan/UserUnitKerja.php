<?php

namespace App\Models\Setting\Jabatan;

use Illuminate\Database\Eloquent\Model;

class UserUnitKerja extends Model
{
    protected $table = 'user_unit_kerja';

    protected $fillable = [
        'user_id',
        'unit_kerja_id',
        'tmt_mulai',
        'tmt_selesai',
        'status',
    ];

    protected $casts = [
        'tmt_mulai' => 'date',
        'tmt_selesai' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function unitKerja()
    {
        return $this->belongsTo(UnitKerja::class);
    }
}
