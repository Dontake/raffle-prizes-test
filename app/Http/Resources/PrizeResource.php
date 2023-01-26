<?php

namespace App\Http\Resources;

use App\Entities\Prize\PrizeEntity;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class PrizeResource extends JsonResource
{
    /**
     * @var PrizeEntity
     */
    public $resource;

    public function __construct(PrizeEntity $resource)
    {
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'type' => $this->resource->getType(),
            'name' => $this->resource->getName(),
            'count' => $this->resource->getCount()
        ];
    }
}
