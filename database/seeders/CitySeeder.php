<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        City::create([
           'name' => 'Алматы'
        ]);
        City::create([
           'name' => 'Астана'
        ]);
       City::create([
           'name' => 'Шымкент'
        ]);
        City::create([
           'name' => 'Актобе'
        ]);
       City::create([
           'name' => 'Караганда'
        ]);
        City::create([
           'name' => 'Тараз'
        ]);
       City::create([
           'name' => 'Усть-Каменогорск'
        ]);
        City::create([
           'name' => 'Павлодар'
        ]);
       City::create([
           'name' => 'Атырау'
        ]);
        City::create([
           'name' => 'Семей'
        ]);
       City::create([
           'name' => 'Кызылорда'
        ]);
        City::create([
           'name' => 'Костанай'
        ]);
       City::create([
           'name' => 'Уральск'
        ]);
        City::create([
           'name' => 'Петропавловск'
        ]);
       City::create([
           'name' => 'Туркестан'
        ]);
        City::create([
           'name' => 'Кокшетау'
        ]);
       City::create([
           'name' => 'Темиртау'
        ]);
        City::create([
           'name' => 'Талдыкорган'
        ]);
        City::create([
           'name' => 'Экибастуз'
        ]);
        City::create([
           'name' => 'Рудный'
        ]);
    }
}
