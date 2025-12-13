<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Setting\Jabatan\UserJabatanFungsional;
use App\Models\Setting\Jabatan\UserJabatanStruktural;
use App\Models\Setting\Jabatan\UserUnitKerja;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function jabatanStrukturals()
    {
        return $this->hasMany(\App\Models\Setting\Jabatan\UserJabatanStruktural::class);
    }

    public function jabatanStrukturalAktif()
    {
        return $this->hasOne(\App\Models\Setting\Jabatan\UserJabatanStruktural::class)
            ->where('status', 'aktif')
            ->whereNull('tmt_selesai')
            ->latest('tmt_mulai');
    }

    // Aktif digunakan
    public function unitKerjaHistori()
    {
        return $this->hasMany(\App\Models\Setting\Jabatan\UserUnitKerja::class)
            ->orderBy('tmt_mulai', 'desc');
    }

    public function unitKerjaAktif()
    {
        return $this->hasOne(\App\Models\Setting\Jabatan\UserUnitKerja::class)
            ->whereNull('tmt_selesai')
            ->latest('tmt_mulai');
    }

    public function jabatanFungsionals()
    {
        return $this->hasMany(\App\Models\Setting\Jabatan\UserJabatanFungsional::class);
    }

    public function jabatanFungsionalAktif()
    {
        return $this->hasOne(\App\Models\Setting\Jabatan\UserJabatanFungsional::class)
            ->where('status', 'aktif')
            ->whereNull('tmt_selesai')
            ->latest('tmt_mulai');
    }
}
