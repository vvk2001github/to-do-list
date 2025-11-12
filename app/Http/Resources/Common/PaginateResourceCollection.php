<?php

namespace App\Http\Resources\Common;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PaginateResourceCollection extends AnonymousResourceCollection
{
    /**
     * @param $request
     * @param $paginated
     * @param $default
     * @return mixed
     */
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
