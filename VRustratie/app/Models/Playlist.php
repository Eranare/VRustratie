<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'created_by'];

    public function videos()
    {
        return $this->belongsToMany(VRVideo::class, 'playlist_videos')->withPivot('order');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_playlists');
    }

    public function accessCodes()
    {
        return $this->hasMany(AccessCode::class);
    }
}