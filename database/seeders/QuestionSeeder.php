<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('questions')->insert(
            [
                [
                    'question'    => 'Что такое балет?',
                    'video_id'    => '1'
                ],
                [
                    'question'    => 'Что такое балетки?',
                    'video_id'    => '1'
                ],
                [
                    'question'    => 'Когда появился балет, 1958г.?',
                    'video_id'    => '1'
                ],
                [
                    'question'    => 'Откуда он пришел?',
                    'video_id'    => '1'
                ],
                [
                    'question'    => 'Как называется растяжка перед тренировкой?',
                    'video_id'    => '2'
                ],
                [
                    'question'    => 'Какой тип растяжки рекомендуется после тренировки?',
                    'video_id'    => '2'
                ],
                [
                    'question'    => 'Что такое статическая растяжка?',
                    'video_id'    => '2'
                ],
                [
                    'question'    => 'Что такое пируэт?',
                    'video_id'    => '3'
                ],
                [
                    'question'    => 'Как зовут балерин?',
                    'video_id'    => '3'
                ],
//                [
//                    'question'    => 'Что такое программирование?',
//                    'video_id'    => '4'
//                ],
//                [
//                    'question'    => 'Какие задачи решают программисты?',
//                    'video_id'    => '4'
//                ],
//                [
//                    'question'    => 'Что такое переменная?',
//                    'video_id'    => '5'
//                ],
//                [
//                    'question'    => 'Как объявить переменную?',
//                    'video_id'    => '5'
//                ],
//                [
//                    'question'    => 'Какие используются операторы?',
//                    'video_id'    => '5'
//                ],
            ]
        );

    }
}
