<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InventoryResource extends JsonResource
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
            'product_id' => $this->product_id,
            'product_name' => $this->product->name,
            'product_number' => $this->product->number,
            'admin_id' => $this->admin_id,
            'number' => $this->number,
            'type' => $this->type,
            'before_quantity' => $this->before_quantity,
            'quantity' => $this->quantity,
            'after_quantity' => $this->after_quantity,
            'remark' => $this->remark,
            'created_at' => date("Y-m-d H:i:s", strtotime($this->created_at)),
            'updated_at' => date("Y-m-d H:i:s", strtotime($this->updated_at))
        ];
    }
}
