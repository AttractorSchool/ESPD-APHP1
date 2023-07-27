<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CustomNotification extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = ['sender_id', 'user_id', 'title', 'body', 'is_read', 'type'];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return BelongsTo
     */
    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /**
     * @return mixed
     */
    public function response()
    {
        $response = Response::where('first_id', $this->sender_id)
            ->where('second_id', $this->user_id)
            ->first();

        if ($response) {
            return $response->id;
        } else {
            return null;
        }
    }
}
