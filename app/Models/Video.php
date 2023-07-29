<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Video extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = ['name', 'video', 'course_id'];

    /**
     * @return BelongsTo
     */
    public function course():BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * @return HasMany
     */
    public function questions(): HasMany
    {
        return  $this->hasMany(Question::class);
    }
}
