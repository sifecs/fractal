<?php

use Illuminate\Database\Seeder;

class LocalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('locales')->insert([
            'name' => 'ru',
        ]);
    }
}
