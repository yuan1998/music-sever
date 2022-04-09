<?php

namespace App\Admin\Repositories;

use App\Models\Singer as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Singer extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
