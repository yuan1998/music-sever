<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class RankList extends Model
{
    use HasDateTimeFormatter;

    protected $table = 'rank_list';
    public $timestamps = false;
    protected $fillable = [
        "songListId",
        "consumerId",
        "score",
    ];

}
