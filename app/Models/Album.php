<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $fillable = ['format_id', 'title', 'artist', 'release_year'];

    public function format()
    {
        return $this->belongsTo(Format::class);
    }
}
