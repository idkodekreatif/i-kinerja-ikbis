<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

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

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
        'last_login_at' => 'datetime',
    ];

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
        // Hapus session lama untuk menghindari konflik
        session()->forget('impersonate');

        // Simpan informasi di session
        session()->put('impersonate', [
            'original_user_id' => $this->id,
            'original_user_name' => $this->name,
            'target_user_id' => $target->id,
            'target_user_name' => $target->name,
            'started_at' => now(),
        ]);

        // Regenerate session ID untuk keamanan
        session()->regenerate();

        // Logout dulu dari user saat ini
        auth()->logout();

        // Clear semua session data kecuali impersonate
        $impersonateData = session('impersonate');
        session()->flush();
        session()->put('impersonate', $impersonateData);

        // Login sebagai user target
        auth()->login($target);

        // Record login untuk user target
        $target->recordLogin();

        // Redirect ke dashboard
        return redirect('/kpi-control-center');
    }

    /**
     * Stop impersonate dan kembali ke user asli
     */
    public function stopImpersonating()
    {
        if ($this->isImpersonated()) {
            $originalUserId = session('impersonate.original_user_id');
            $originalUser = User::find($originalUserId);

            if ($originalUser) {
                // Hapus session impersonate
                session()->forget('impersonate');

                // Logout dari user saat ini
                auth()->logout();

                // Login kembali sebagai user asli
                auth()->login($originalUser);

                // Regenerate session
                session()->regenerate();

                return redirect('/kpi-control-center');
            }
        }

        return redirect('/kpi-control-center');
    }

    /**
     * Cek apakah sedang di-impersonate
     */
    public function isImpersonated(): bool
    {
        return session()->has('impersonate') &&
            session('impersonate.target_user_id') == $this->id;
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
     * Dapatkan informasi impersonate
     */
    public function getImpersonateInfo(): ?array
    {
        return session('impersonate');
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
