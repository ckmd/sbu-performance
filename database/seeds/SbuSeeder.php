<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SbuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $batch = [
            ['nama' => 'SBU REG BALI DAN NUSRA'], 
            ['nama' => 'SBU REG JAWA BAGIAN BARAT'],
            ['nama' => 'SBU REG JAWA BAGIAN TENGAH'],
            ['nama' => 'SBU REG JAWA BAGIAN TIMUR'],
            ['nama' => 'SBU REG KALIMANTAN'],
            ['nama' => 'SBU REG SULAWESI DAN IBT'],
            ['nama' => 'SBU REG SUMATERA BAG SELATAN'],
            ['nama' => 'SBU REG SUMATERA BAG TENGAH'],
            ['nama' => 'SBU REG SUMATERA BAG UTARA'],
            ['nama' => 'SBU RO JAKARTA']
        ];
        DB::table('sbus')->insert($batch);
    }
}
