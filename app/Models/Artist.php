<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasFactory;

    protected $fillable = [ 'name' ];


    public function mp3s()
    {
        return $this->hasMany(Mp3File::class, 'author_id');
    }

    public function albums()
    {
        return $this->hasMany(Album::class);
    }
}
