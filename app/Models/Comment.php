<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Comment extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'comment';
//    public $timestamps = false;
    const CREATED_AT = 'create_time';
    const UPDATED_AT = null;

    protected $fillable = [
        "up",
        "song_list_id",
        "song_id",
        "user_id",
        "type",
        "content"
    ];

    /**
     * 关联 歌单
     * @return BelongsTo
     */
    public function songList(): BelongsTo
    {
        return $this->belongsTo(SongList::class , 'song_list_id' , 'id');
    }

    /**
     * 关联用户
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(Consumer::class, 'user_id' , 'id');
    }

    /**
     * 关联 歌曲
     * @return BelongsTo
     */
    public function song(): BelongsTo
    {
        return $this->belongsTo(Song::class, 'song_id' , 'id');
    }

}
