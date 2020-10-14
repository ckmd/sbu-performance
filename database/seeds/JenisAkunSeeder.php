<?php

use Illuminate\Database\Seeder;

class JenisAkunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $batch = [
            ['nama' => 'pusat'], 
            ['nama' => 'daerah']
        ];
        DB::table('jenis_akuns')->insert($batch);
        //
    }
}
