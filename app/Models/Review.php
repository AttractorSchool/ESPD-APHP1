<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Where;
use Orchid\Screen\AsSource;

class Review extends Model
{
    use HasFactory, AsSource, Filterable;

    /**
     * @var string[]
     */
    protected $fillable = ['user_id', 'body'];
    /**
     * @var array
     */
    protected $allowedFilters = [
        'id' => Where::class
    ];

    /**
     * @var array
     */
    protected $allowedSorts = [
        'id'
        ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
