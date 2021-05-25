<?php

namespace App\Traits;

use Webpatser\Uuid\Uuid as WebpasterUuid;

trait Uuid
{

    /**
     * Boot function from laravel.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = WebpasterUuid::generate()->string;
        });
    }
}
