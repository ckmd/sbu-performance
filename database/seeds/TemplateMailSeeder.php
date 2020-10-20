<?php

use Illuminate\Database\Seeder;

class TemplateMailSeeder extends Seeder
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
                'subject' => 'default Subject',
                'description' => 'default Description',
            ],
        ];
        DB::table('template_mails')->insert($batch);
        //
    }
}
