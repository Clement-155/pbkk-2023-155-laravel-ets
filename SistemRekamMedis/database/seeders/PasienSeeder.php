<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PasienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        $pasien_data = array(
            "Satu",
            "Dua",
            "Tiga",
            "Empat",
            "Lima"
        );

        foreach ($pasien_data as $pasien) {
            DB::table('pasiens')->insert([
                'nik' => Str::random(16),
                'nama_lengkap' => $pasien,
            ]);
        }
    }
}
