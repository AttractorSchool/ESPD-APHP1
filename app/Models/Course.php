<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = ['name', 'author_id', 'interest_id', 'mini_description', 'description'];

    /**
     * @return BelongsTo
     */
    public function user():BelongsTo
    {
       return $this->belongsTo(User::class, 'author_id', 'id');
    }

    public function interest():BelongsTo
    {
        return  $this->belongsTo(Interest::class, 'interest_id');
    }

    /**
     * @return HasMany
     */
    public function videos():HasMany
    {
        return $this->hasMany(Video::class);
    }
}
