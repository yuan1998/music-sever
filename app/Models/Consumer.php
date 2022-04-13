<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authentication;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Consumer extends Authentication implements JWTSubject
{
    use HasFactory, Notifiable;
    use HasDateTimeFormatter;

    protected $table = 'consumer';
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';

    const SEX_LIST = [
        0 => '女',
        1 => '男',
    ];

    protected $fillable = [
        'username',
        'password',
        'sex',
        'email',
        'phone_num',
        'location',
        'birth',
        'introduction',
        'avator',
        'interest',
        'create_time',
        'update_time',
    ];

    protected $casts = [
        'interest' => 'json'
    ];


    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims(): array
    {
        return [];
    }

    public function collectSong(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Song::class, 'collect', 'user_id', 'song_id');
    }

    public function collectSongList(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(SongList::class, 'collect', 'user_id', 'song_list_id');
    }

}
