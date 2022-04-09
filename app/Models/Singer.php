<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class Singer extends Model
{
    use HasDateTimeFormatter;

    protected $table = 'singer';
    public $timestamps = false;


    // 性别
    public static $sex = [
        0 => '女',
        1 => '男',
    ];

}
