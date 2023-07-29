<?php

namespace Database\Seeders;

use App\Models\Video;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('videos')->insert([
            //            'Введение в курсы балета' =>
            [
                'name'      => 'Введение в курсы балета',
                'video'     => 'Вводный урок',
                'course_id' => '1'
            ],
//            'Урок-1 балета, как правильно делать растяжку' =>
            [
                'name'      => 'Урок-1 балета, как правильно делать растяжку',
                'video'     => 'Урок 1',
                'course_id' => '1'
            ],
//            'Урок-2 Лебединое озеро' =>
            [
                'name'      => 'Урок-2 Лебединое озеро',
                'video'     => 'Урок 2',
                'course_id' => '1'
            ],
//            [
//                'name'      => 'Введение в курсы программирования',
//                'video'     => 'Вводный урок',
//                'course_id' => '2'
//            ],
//            [
//                'name'      => 'Урок-2 переменные',
//                'video'     => 'Урок-1',
//                'course_id' => '2'
//            ]
        ]);
    }
}
