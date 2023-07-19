<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Response extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_id',
        'second_id',
        'confirm_first',
        'confirm_second',
    ];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function first(): BelongsTo
    {
        return $this->belongsTo(User::class, 'first_id');
    }

    public function second(): BelongsTo
    {
        return $this->belongsTo(User::class, 'second_id');
    }

    public function last_Message()
    {
        return $this->messages()->latest()->first();
    }

    public function print($link): void
    {
        $html = '
       <a href="' . $link . '" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
            <div class="d-flex row col-11">
                <img src="https://media.sproutsocial.com/uploads/2022/06/profile-picture.jpeg" alt="Иван" class="rounded-5 col-3 m-0" style="height: 3.8rem">
                <div class="d-flex flex-column col-9 m-0">
                    <span class="ml-2 fs-6">Иван</span>
                    <p class="text-dark text-start fst-italic" style="height: 2rem">' . $this->last_Message()->body . '</p>
                </div>
            </div>
            <span class="badge badge-primary badge-pill text-dark">' . $this->last_Message()->created_at->format(
                'D'
            ) . '</span>
        </a>';

        print $html;
    }
}
