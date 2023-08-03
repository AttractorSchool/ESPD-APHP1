<?php

namespace App\Orchid\Screens\Video;

use App\Http\Requests\AdminCourseRequest;
use App\Http\Requests\AdminVideoRequest;
use App\Models\Course;
use App\Models\Video;
use Illuminate\Http\RedirectResponse;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class VideoEditScreen extends Screen
{
    /** @var ?string $name */
    public ?string $name = 'Video Create';
    /** @var ?string $description */
    public ?string $description = 'Video form';
    /** @var bool $exists */
    protected bool $exists = false;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Video $video): iterable
    {
        $this->exists = $video->exists;

        if ($this->exists) {
            $this->name = 'Video Edit';
        }

        return compact('video');
    }

    /**
     * The screen's action buttons.
     *
     * @return Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Создать видео')
                ->icon('pencil')
                ->method('save')
                ->canSee(!$this->exists),
            Button::make('Обновить видео')
                ->icon('note')
                ->method('save')
                ->canSee($this->exists),
            Button::make('Удалить')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->exists),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::rows([
                Input::make('video.name')
                    ->title('Названия курса')
                    ->type('text')
                    ->required(),
                Relation::make('video.course_id')
                    ->title('К какому курсу относиться видео')
                    ->fromModel(Course::class, 'name', 'id')->required(),
                Upload::make('video.video')
                    ->title('Загрузите видео')
                    ->acceptedFiles('.mp4, .avi,.mkv')
                    ->maxFiles(1)
            ])
        ];
    }

    /**
     * @param Video $video
     * @param AdminVideoRequest $request
     * @return RedirectResponse
     */
    public function save(Video $video, AdminVideoRequest $request): RedirectResponse
    {
        dump($request);
        $video->fill($request->get('video'))->save();

        Alert::info(
            sprintf(
                'You are successfully %s an course',
                $this->exists ? 'updated' : 'created'
            )
        );

        return redirect()->route('platform.video.list');
    }


    /**
     * @param Video $video
     * @return RedirectResponse
     */
    public function remove(Video $video): RedirectResponse
    {
        if ($video->delete()) {
            Alert::info('You have successfully deleted');
            return redirect()->route('platform.course.list');
        }

        Alert::warning('An error has occurred');

        return redirect()->route('platform.course.edit', $video);
    }
}
