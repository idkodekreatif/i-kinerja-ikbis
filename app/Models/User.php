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

    public function jabatanFungsionals()
    {
        return $this->hasMany(UserJabatanFungsional::class, 'user_id');
    }

    public function jabatanStrukturals()
    {
        return $this->hasMany(UserJabatanStruktural::class, 'user_id');
    }

    public function unitKerjaHistori()
    {
        return $this->hasMany(UserUnitKerja::class, 'user_id');
    }

    // Accessor untuk jabatan fungsional aktif
    public function getJabatanFungsionalAktifAttribute()
    {
        return $this->jabatanFungsionals()
            ->where('status', 'aktif')
            ->whereNull('tmt_selesai')
            ->orderBy('tmt_mulai', 'desc')
            ->first();
    }

    // Accessor untuk jabatan struktural aktif
    public function getJabatanStrukturalAktifAttribute()
    {
        return $this->jabatanStrukturals()
            ->where('status', 'aktif')
            ->whereNull('tmt_selesai')
            ->orderBy('tmt_mulai', 'desc')
            ->first();
    }

    // Accessor untuk unit kerja aktif
    public function getUnitKerjaAktifAttribute()
    {
        return $this->unitKerjaHistori()
            ->whereNull('tmt_selesai')
            ->orderBy('tmt_mulai', 'desc')
            ->first();
    }
}
