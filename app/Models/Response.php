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
}
