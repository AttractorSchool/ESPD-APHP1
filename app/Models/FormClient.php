<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormClient extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = ['name', 'email', 'message'];
}
