<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VRVideo extends Model
{
    use HasFactory;
    protected $table = 'vr_videos';
    protected $fillable = ['title', 'description', 'video_url'];

    public function playlists()
    {
        return $this->belongsToMany(Playlist::class, 'playlist_videos')->withPivot('order');
    }
}