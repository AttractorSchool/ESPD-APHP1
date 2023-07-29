<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = ['question', 'video_id'];

    /**
     * @return BelongsTo
     */
    public function video():BelongsTo
    {
        return $this->belongsTo(Video::class, 'video_id');
    }

    public function answers():HasMany
    {
        return $this->hasMany(Answer::class);
    }
}
