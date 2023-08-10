<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Like;
use Orchid\Screen\AsSource;

class Event extends Model
{
    use HasFactory, Filterable, AsSource;

    /**
     * @var string[]
     */
    protected $fillable = [
        'title',
        'description',
        'date',
        'location',
        'price',
        'picture',
        'format',
        'quantity',
        'author_id',
        'time'
    ];

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
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class,'author_id');
    }
}
