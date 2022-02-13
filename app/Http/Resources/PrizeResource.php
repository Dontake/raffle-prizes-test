<?php

namespace App\Http\Resources;

use App\Entities\DTO\PrizeDTO;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class PrizeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        /** @var PrizeDTO $this */
        return [
            'type' => $this->getType(),
            'name' =>'',
        ];
    }
}
