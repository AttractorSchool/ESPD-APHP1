<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Favourite extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'mentor_id', 'course_id', 'events_id'];

    /**
     * @return BelongsTo
     */
    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function mentor():BelongsTo{
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function course():BelongsTo{
        return $this->belongsTo(Course::class);
    }

    /**
     * @return BelongsTo
     */
    public function event():BelongsTo{
        return $this->belongsTo(Event::class);
    }
}
