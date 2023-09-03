<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Response extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'first_id',
        'second_id',
        'confirm_first',
        'confirm_second',
    ];

    /**
     * @return HasMany
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    /**
     * @return BelongsTo
     */
    public function first(): BelongsTo
    {
        return $this->belongsTo(User::class, 'first_id');
    }

    /**
     * @return BelongsTo
     */
    public function second(): BelongsTo
    {
        return $this->belongsTo(User::class, 'second_id');
    }

    public function last_Message()
    {
        return $this->messages()->latest()->first();
    }
}
