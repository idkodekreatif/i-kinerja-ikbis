<?php

namespace App\Http\Controllers\Setting\Indikator;

use App\Http\Controllers\Controller;
use App\Models\Setting\Indikator\KomponenPoin;
use Illuminate\Http\Request;

class KomponenPoinController extends Controller
{
    // Ambil semua data
    public function index()
    {
        return KomponenPoin::all();
    }

    // Ambil data berdasarkan komponen
    public function show($nama)
    {
        return KomponenPoin::where('nama_komponen', $nama)->first();
    }

    // Ambil poin berdasarkan komponen dan jabatan
    public function getPoin($namaKomponen, $jabatan)
    {
        $komponen = KomponenPoin::where('nama_komponen', $namaKomponen)->first();

        if (!$komponen) return null;

        $mapping = [
            'non-jad' => 'non_jad',
            'aa' => 'aa',
            'lektor' => 'lektor',
            'lk' => 'lk',
            'gb' => 'gb'
        ];

        $column = $mapping[$jabatan] ?? $jabatan;
        return $komponen->{$column} ?? null;
    }
}
