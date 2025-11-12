<?php

namespace App\Http\Resources\Common;

use App\Http\Resources\Common\PaginateResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class CommonJsonResource extends JsonResource
{
    public function created(): static
    {
        $this->statusCode = Response::HTTP_CREATED;
        return $this;
    }

    public function deleted(): static
    {
        $this->statusCode = Response::HTTP_NO_CONTENT;
        return $this;
    }

    public static function collection($resource): PaginateResourceCollection
    {
        return tap(new PaginateResourceCollection($resource, static::class), function ($collection) {
            if (property_exists(static::class, 'preserveKeys')) {
                $collection->preserveKeys = (new static([]))->preserveKeys === true;
            }
        });
    }
}