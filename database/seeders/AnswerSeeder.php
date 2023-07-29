<?php

namespace Database\Seeders;

use App\Models\Answer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use function Symfony\Component\Translation\t;

class AnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('answers')->insert([
            [
            'text'        => 'Вид танцев',
            'boolean'     =>  true,
            'question_id' => '1'
            ],
            [
                'text'        => 'Вид боевых искусств',
                'boolean'     => false,
                'question_id' => '1'
            ],
            [
                'text'        => 'Вид с улицы',
                'boolean'     => false,
                'question_id' => '1'
            ],
            [
                'text'        => 'Бэтмен!',
                'boolean'     => false,
                'question_id' => '1'
            ],
            [
                'text'        => 'Специальная обувь в балете',
                'boolean'     => true,
                'question_id' => '2'
            ],
            [
                'text'        => 'Защитная обувь',
                'boolean'     => false,
                'question_id' => '2'
            ],
            [
                'text'        => 'Зимняя обувь',
                'boolean'     => false,
                'question_id' => '2'
            ],
            [
                'text'        => 'Где детонатор?',
                'boolean'     => false,
                'question_id' => '2'
            ],
            [
                'text'        => null,
                'boolean'     => true,
                'question_id' => '3'
            ],
            [
                'text'        => null,
                'boolean'     => false,
                'question_id' => '3'
            ],
            [
                'text'        => 'Казахстан',
                'boolean'     => false,
                'question_id' => '4'
            ],
            [
                'text'        => 'Италия',
                'boolean'     => true,
                'question_id' => '4'
            ],
            [
                'text'        => 'Африка',
                'boolean'     => false,
                'question_id' => '4'
            ],
            [
                'text'        => 'Германия',
                'boolean'     => false,
                'question_id' => '4'
            ],
            [
                'text'        => 'Приводящая растяжка',
                'boolean'     => true,
                'question_id' => '5'
            ],

            [
                'text'        => 'Специальная растяжка',
                'boolean'     => false,
                'question_id' => '5'
            ],
            [
                'text'        => 'Динамическая растяжка',
                'boolean'     => false,
                'question_id' => '5'
            ],
            [
                'text'        => 'Динамическая растяжка',
                'boolean'     => true,
                'question_id' => '6'
            ],
            [
                'text'        => 'Статическая растяжка',
                'boolean'     => false,
                'question_id' => '6'
            ],
            [
                'text'        => 'Гибкая растяжка',
                'boolean'     => false,
                'question_id' => '6'
            ],
            [
                'text'        => 'Неподвижная растяжка',
                'boolean'     => true,
                'question_id' => '7'
            ],
            [
                'text'        => 'Динамическая растяжка',
                'boolean'     => false,
                'question_id' => '7'
            ],
            [
                'text'        => 'Самостоятельная растяжка',
                'boolean'     => false,
                'question_id' => '7'
            ],
            [
                'text'        => 'Вращение на одной ноге',
                'boolean'     => true,
                'question_id' => '8'
            ],
            [
                'text'        => 'Вращение на двух ноге',
                'boolean'     => false,
                'question_id' => '8'
            ],
            [
                'text'        => 'Вращение на трех ноге',
                'boolean'     => false,
                'question_id' => '8'
            ],
            [
                'text'        => 'Анна Павлова',
                'boolean'     => true,
                'question_id' => '9'
            ],
            [
                'text'        => 'У них есть имена????',
                'boolean'     => false,
                'question_id' => '9'
            ],
            [
                'text'        => 'Разве не просто балерина',
                'boolean'     => false,
                'question_id' => '9'
            ],
            [
                'text'        => 'Джеймс, Джеймс Бонд',
                'boolean'     => false,
                'question_id' => '9'
            ],
        ]);
    }
}
