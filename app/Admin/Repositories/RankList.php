<?php

namespace App\Admin\Repositories;

use App\Models\RankList as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class RankList extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
