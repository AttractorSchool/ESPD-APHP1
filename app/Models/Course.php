<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Like;
use Orchid\Screen\AsSource;

class Course extends Model
{
    use HasFactory, Filterable, AsSource;

    /**
     * @var string[]
     */
    protected $fillable = ['name', 'author_id', 'interest_id', 'mini_description', 'description'];

    /**
     * @var string[]
     */
    protected $allowedFilters = [
        'id' => Like::class
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'updated_at',
        'created_at',
    ];


    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    public function interest(): BelongsTo
    {
        return $this->belongsTo(Interest::class, 'interest_id');
    }

    /**
     * @return HasMany
     */
    public function videos(): HasMany
    {
        return $this->hasMany(Video::class);
    }
}
