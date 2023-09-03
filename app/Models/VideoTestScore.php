<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VideoTestScore extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'video_id', 'score'];
    public function video():BelongsTo
    {
        return $this->belongsTo(Video::class, 'video_id', 'id');
    }
}
