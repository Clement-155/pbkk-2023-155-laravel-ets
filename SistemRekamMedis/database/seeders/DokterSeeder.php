<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DokterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dokter_data = array(
            "Alpha",
            "Beta",
            "Gamma",
            "Theta",
            "Epsilon"
        );

        foreach ($dokter_data as $dokter) {
            DB::table('dokters')->insert([
                'nik' => Str::random(16),
                'nama_lengkap' => $dokter,
            ]);
        }
    }
}
