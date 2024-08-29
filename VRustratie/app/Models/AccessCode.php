<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessCode extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'playlist_id', 'generated_by', 'is_active'];

    public function playlist()
    {
        return $this->belongsTo(Playlist::class);
    }

    public function generator()
    {
        return $this->belongsTo(User::class, 'generated_by');
    }
}