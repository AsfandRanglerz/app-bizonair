<?php

namespace App\Http\Resources;

use App\Http\Resources\Concerns\Pagination;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;

class FirebaseTokenCollection extends ResourceCollection
{
    use Pagination;
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if ( $this->resource instanceof LengthAwarePaginator ) {
            return $this->paginate ();
        }
        return [
            'data' => $this->collection,
        ];
    }
}
