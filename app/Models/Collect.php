<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class Collect extends Model
{
    use HasDateTimeFormatter;

    protected $table = 'collect';

    const CREATED_AT = 'create_time';
    const UPDATED_AT = null;

    protected $fillable = [
        "user_id",
        "type",
        "song_id",
        "song_list_id",
    ];


}
