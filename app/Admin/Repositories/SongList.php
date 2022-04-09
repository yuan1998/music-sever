<?php

namespace App\Admin\Repositories;

use App\Models\SongList as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class SongList extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;

    public static function indexQuery()
    {
        return Model::query()
            ->with(['createBy']);
    }
}
