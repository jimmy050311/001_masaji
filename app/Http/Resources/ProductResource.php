<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'number' => $this->number,
            'image' => $this->image,
            'category_id' => (int)$this->category_id,
            'category_name' => $this->category->name,
            'price' => $this->price,
            'spec' => $this->spec,
            'desc' => $this->desc,
            'introduction' => $this->introduction,
            'low_amount' => $this->low_amount,
            'minute' => $this->minute,
            'amount' => $this->amount,
            'status' => $this->status,
            'type' => $this->type,
            'image_data' => ProductImageResource::collection($this->productImage),
            'created_at' => date("Y-m-d H:i:s", strtotime($this->created_at)),
            'updated_at' => date("Y-m-d H:i:s", strtotime($this->updated_at))
        ];
    }
}
