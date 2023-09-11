<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Screen\AsSource;

class Calendar extends Model
{
    use AsSource, Attachable;

    protected $fillable = ['created_at', 'updated_at'];
}
