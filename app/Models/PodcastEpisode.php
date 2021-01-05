<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PodcastEpisode extends Model
{
    use HasFactory;

    protected $fillable = [
        'episode_title',
        'episode_id',
        'podcast_name',
        'podcast_id',
        'duration'
    ];
}
