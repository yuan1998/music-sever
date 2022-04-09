<?php

namespace App\Admin\Repositories;

use App\Models\Song as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Song extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;

    public static function indexQuery(): \Illuminate\Database\Eloquent\Builder
    {

        $query = Model::query();
        if ($id = request()->get('singer_id')) {
            $query->where('singer_id', $id);
        } else if ($listId = request()->get('song_list_id')) {
            $query->whereHas('songList', function ($query) use ($listId) {
                return $query->where('song_list_id', $listId);
            });

        }
        return $query;
    }
}
