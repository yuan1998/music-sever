<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class SongList extends Model
{
    use HasDateTimeFormatter;

    protected $table = 'song_list';
    public $timestamps = false;

    public function createBy(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Consumer::class,'id','create_by');
    }

    public function comments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Comment::class, 'song_list_id', 'id');
    }

    public function rank(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(RankList::class, 'songListId', 'id');
    }

    public function song()
    {
        return $this->belongsToMany(Song::class, 'list_song', 'song_list_id', 'id');
    }

}
