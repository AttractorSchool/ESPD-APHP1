<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_id',
        'second_id',
        'confirm_first',
        'confirm_second',
    ];


    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
