<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(SbuSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(KpiSeeder::class);
        $this->call(JenisAkunSeeder::class);
    }
}
