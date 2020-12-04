<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
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
                'name' => 'admin_panel',
                'display_name' => 'доступ в админскую панель',
                'description' => 'доступ в админскую панель'
            ],
            [
                'name' => 'categories_control',
                'display_name' => 'управление категориями',
                'description' => 'Полное управление категориями(Создание, редактирование, удаление)'
            ],
            [
                'name' => 'locales_control',
                'display_name' => 'управление локализацией сайта',
                'description' => 'Полное управление локализацией сайта(Создание, редактирование, удаление)'
            ],
            [
                'name' => 'users_control',
                'display_name' => 'Управление пользователями',
                'description' => 'Полное управление пользователями (Создание, редактирование, удаление)'
            ],
            [
                'name' => 'roles_control',
                'display_name' => 'Управление ролями',
                'description' => 'Полное управление ролями(Создание, редактирование, удаление)'
            ],
            [
                'name' => 'Company_control',
                'display_name' => 'Управление компаниями',
                'description' => 'Полное управление компаниями(Создание, редактирование, удаление)'
            ],
        ];
        DB::table('permissions')->insert($data);
    }
}
