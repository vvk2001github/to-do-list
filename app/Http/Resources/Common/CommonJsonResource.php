<?php

namespace App\Http\Resources\Common;

use App\Http\Resources\Common\PaginateResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class CommonJsonResource extends JsonResource
{
    public static function collection($resource): PaginateResourceCollection
    {
        return tap(new PaginateResourceCollection($resource, static::class), function ($collection) {
            if (property_exists(static::class, 'preserveKeys')) {
                $collection->preserveKeys = (new static([]))->preserveKeys === true;
            }
        });
    }
}