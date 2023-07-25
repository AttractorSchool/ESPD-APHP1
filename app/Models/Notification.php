<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Notification extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = ['first_id', 'second_id', 'title', 'body'];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'first_id');
    }

    public function response()
    {
        $response_all = \App\Models\Response::all();
        $response = $response_all->where('first_id', $this->first_id)->where('second_id', $this->second_id);

        return $response->first()->id;
    }
}
