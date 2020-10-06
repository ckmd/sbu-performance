<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $batch = [
            ['nama' => 'superadmin'], 
            ['nama' => 'manager']
        ];
        DB::table('roles')->insert($batch);
    }
}
