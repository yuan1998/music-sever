<?php

namespace App\Admin\Repositories;

use App\Models\Consumer as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Consumer extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
