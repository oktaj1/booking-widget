<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;

trait HasUlid
{
    public static function bootHasUlid()
    {
        static::creating(function (Model $model) {
            if (empty($model->ulid)) {
                $model->ulid = (string) \Illuminate\Support\Str::ulid(); // Generate a ULID
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'ulid';
    }
}
