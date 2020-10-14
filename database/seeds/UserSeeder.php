<?php

use Illuminate\Database\Seeder;
use JeroenZwart\CsvSeeder\CsvSeeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends CsvSeeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function __construct()
    {
        $this->file = '/database/seeds/csvs/user.csv';
        $this->tablename = 'users';
        $this->delimiter = ",";
        $this->header = false;
        $this->mapping = [
            0 => "role_id",
            1 => "sbu_id",
            2 => "name",
            3 => "email",
            4 => "password",
        ];
        $this->hashable = ['password', 'salt'];
        $this->timestamps = true;
    }

    public function run()
    {
        DB::disableQueryLog();
        parent::run();
    }
}
