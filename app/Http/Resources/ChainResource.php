<?php

namespace App\Http\Resources;

use App\Models\Chain;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Chain
 */
class ChainResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
