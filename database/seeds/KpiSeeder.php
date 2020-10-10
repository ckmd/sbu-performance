<?php

use Illuminate\Database\Seeder;

class KpiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $batch = [
            ['Nilai kpi' => 480], 
        ];
        DB::table('kpis')->insert($batch);
    }
}
