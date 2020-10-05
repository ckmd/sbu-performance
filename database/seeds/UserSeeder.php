<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $batch = [
            [
                'role_id' => 1,
                'sbu_id' => null,
                'name' => 'superadmin',
                'email' => 'admin.slareporting@iconpln.co.id',
                'password' => Hash::make('password'),
            ], [
                'role_id' => 2,
                'sbu_id' => 1,
                'name' => 'admin.balinusra',
                'email' => 'admin.balinusra@iconpln.co.id',
                'password' => Hash::make('password'),
            ], [
                'role_id' => 2,
                'sbu_id' => 2,
                'name' => 'admin.jabar',
                'email' => 'admin.jabar@iconpln.co.id',
                'password' => Hash::make('password'),
            ]
        ];
        DB::table('users')->insert($batch);
    }
}
