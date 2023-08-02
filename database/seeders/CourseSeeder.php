<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Course::factory()->create([
//            [
                'name'             => 'Курсы по балету',
                'photo'            => $this->getImage(2),
                'author_id'        => '5',
                'interest_id'      => rand(1, 10),
                'mini_description' => 'Курсы балета представляют собой обучающие программы, которые предназначены для развития
                техники и искусства классического балета у студентов различных возрастов и уровней подготовки.',
                'description'      =>'Балет - это высокохудожественное танцевальное искусство, сочетающее в себе
                элегантные движения, выразительность и музыкальность. Основанная на классической технике, эта
                форма искусства использует позы, па, прыжки и пируэты, чтобы рассказать уникальные и захватывающие
                истории. Балетные спектакли завораживают зрителей своим красивым исполнением, эмоциональностью и
                волшебной атмосферой, создаваемой на сцене.',
//                    ],
//            [
//                'name'             => 'Курсы по программированию',
//                'author_id'        => '5',
//                'interest_id'      => rand(1, 10),
//                'mini_description' => 'Курсы программирования - это обучающие программы, предназначенные для
//                приобретения навыков и знаний в области программирования.',
//                'description'      =>'Курсы программирования предоставляют студентам возможность изучить основы и продвинутые
//                 концепции программирования. Участники получат практические знания в различных языках программирования,
//                 позволяющие разрабатывать программы, веб-приложения, мобильные приложения и другие программные решения.
//                 Курсы также помогают студентам развить логическое мышление, решение проблем и креативность в области
//                 разработки программного обеспечения.',
//                ],
            ]);
    }
    /**
     * @param int $imageNumber
     * @return string
     */
    private function getImage(int $imageNumber = 1): string
    {
        $path      = storage_path() . "/seed_pictures/" . $imageNumber . ".jpg";
        $imageName = md5($path) . '.jpg';
        $image     = 'pictures/' . $imageName;
        $resize    = Image::make($path)->fit(300)->encode('jpg');
        Storage::disk('public')->put($image, $resize->__toString());

        return $image;
    }
}
