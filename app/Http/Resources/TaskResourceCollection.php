<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TaskResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }

    public function paginationInformation($request, $paginated, $default)
    {
        $default['pagination'] = [
            'current_page' => $default['meta']['current_page'],
            'last_page' => $default['meta']['last_page'],
            'per_page' => $default['meta']['per_page'],
            'total' => $default['meta']['total'],
        ];

        unset($default['meta']);
        unset($default['links']);

        return $default;
    }
}
