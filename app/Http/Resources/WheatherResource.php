<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WheatherResource extends JsonResource
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
            'temp'            => $this->temp,
            'pressure'        => $this->pressure,
            'humidity'        => $this->humidity,
            'temp_min'        => $this->temp_min,
            'temp_max'        => $this->temp_max,
        ];
    }
}
