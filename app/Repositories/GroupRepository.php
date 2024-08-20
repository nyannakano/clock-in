<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Group;

class GroupRepository extends AbstractRepository
{
    protected static $model = Group::class;

    public static function findByName(string $name)
    {
        return self::loadModel()::query()->where('name', $name)->first();
    }
}
