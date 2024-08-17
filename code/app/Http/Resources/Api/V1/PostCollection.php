<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PostCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection,
            'links' => [
                'first' => $this->url(1),
                'last' => $this->url($this->lastPage()),
                'prev' => $this->previousPageUrl(),
                'next' => $this->nextPageUrl(),
            ],
            'meta' => [
                'current_page' => $this->currentPage(),
                'from' => $this->firstItem(),
                'last_page' => $this->lastPage(),
                'path' => $this->path(),
                'per_page' => $this->perPage(),
                'to' => $this->lastItem(),
                'total' => $this->total(),
            ],
        ];
    }

//    public function toArray(Request $request): array
//    {
//        return $this->collection->toArray();
//    }
//
//    public function with(Request $request): array
//    {
//        return [
//            'links' => [
//                'first' => $this->url(1),
//                'last' => $this->url($this->lastPage()),
//                'prev' => $this->previousPageUrl(),
//                'next' => $this->nextPageUrl(),
//            ],
//            'meta' => [
//                'current_page' => $this->currentPage(),
//                'from' => $this->firstItem(),
//                'last_page' => $this->lastPage(),
//                'path' => $this->path(),
//                'per_page' => $this->perPage(),
//                'to' => $this->lastItem(),
//                'total' => $this->total(),
//            ],
//        ];
//    }
}
