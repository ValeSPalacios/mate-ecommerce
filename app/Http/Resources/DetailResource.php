<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class DetailResource extends JsonResource
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
            'id'            =>  $this->id,
            'name'         =>  $this->product->name,
            'cost_price'  =>  $this->cost_price,
            'count'=>$this->count,
            'final_price'=>(((($this->increase * $this->cost_price) / 100) + $this->cost_price) * $this->count)
        ];
    }
}
