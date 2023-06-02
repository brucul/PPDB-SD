<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'id' => 1,
            'school_name' => 'UPTD SD Negeri 49 Parepare',
            'school_year' => '2023/2024',
            'school_address' => 'Jl. Jend. A. Yani Km. 3 Parepare, Lapadde, Ujung, Parepare, Sulawesi Selatan',
            'zonasi_quota' => 25,
            'prestasi_quota' => 5,
            'start_date' => date('Y-m-d'),
            'end_date' => date('Y-m-d'),
        ]);
    }
}
