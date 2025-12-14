<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Setting\Jabatan\UserJabatanFungsional;
use App\Models\Setting\Jabatan\UserJabatanStruktural;
use App\Models\Setting\Jabatan\UserUnitKerja;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'is_active',
        'last_login_at',
        'last_login_ip',
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
            'is_active' => 'boolean',
            'last_login_at' => 'datetime',
        ];
    }

    public function recordLogin(): void
    {
        $this->update([
            'last_login_at' => now(),
            'last_login_ip' => request()->ip(),
        ]);
    }

    /**
     * Mulai impersonate sebagai user lain
     */
    public function impersonate(User $target)
    {
        session()->put('impersonate', [
            'original_user_id' => $this->id,
            'target_user_id'   => $target->id,
            'started_at'       => now(),
        ]);

        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        auth()->login($target);
        request()->session()->regenerate();

        $target->recordLogin();

        return redirect()->to('/kpi-control-center');
    }

    /**
     * Stop impersonate dan kembali ke user asli
     */
    public function stopImpersonating()
    {
        $originalId = session('impersonate.original_user_id');

        session()->forget('impersonate');

        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        auth()->loginUsingId($originalId);
        request()->session()->regenerate();

        return redirect()->to('/kpi-control-center');
    }

    /**
     * Cek apakah sedang di-impersonate
     */
    public function isImpersonated(): bool
    {
        return session()->has('impersonate')
            && session('impersonate.target_user_id') === $this->id;
    }

    public function getImpersonateInfo(): ?array
    {
        return session('impersonate');
    }


    /**
     * Cek apakah sedang melakukan impersonate
     */
    public function isImpersonating(): bool
    {
        return session()->has('impersonate') &&
            session('impersonate.original_user_id') == $this->id;
    }

    /**
     * Scope untuk user aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope untuk user nonaktif
     */
    public function scopeInactive($query)
    {
        return $query->where('is_active', false);
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
