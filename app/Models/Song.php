<?php

namespace App\Models;

use Carbon\Carbon;
use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Song extends Model
{
    use HasDateTimeFormatter;

    protected $table = 'song';
    public $timestamps = false;

    public function songList(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(SongList::class, 'list_song', 'song_id', 'id');
    }

    public static function getEverDaySong()
    {
        $date = Carbon::now()->toDateString();
        $key = "{$date}_song_3";
        $cache = Cache::get($key);
        if ($cache) {
            $data = static::query()
                ->whereIn('id', $cache)
                ->get();
        } else {
            $data = static::inRandomOrder()->limit(10)->get();

            $id = $data->pluck('id');
            $data = $data->sortBy('id');
            Cache::put($key, $id,\DateInterval::createFromDateString('1 days'));
        }

        return $data;
    }

}
