<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mp3File extends Model
{
    use HasFactory;

    protected $guarded = ['album'];
}
