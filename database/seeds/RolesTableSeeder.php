<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'admin',
                'display_name' => 'Администратор сайта',
                'description' => 'Полный доступ ко всему сайту'
            ],
            [
                'name' => 'moderator',
                'display_name' => 'модератор сайта',
                'description' => 'модератор сайта'
            ]
        ];
        DB::table('roles')->insert($data);
    }
}
