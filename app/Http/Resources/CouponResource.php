<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CouponResource extends JsonResource
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
            'category_id' => $this->categoryCouponRelation->category_id,
            'category_name' => $this->categoryCouponRelation->category->name,
            'discount' => $this->discount,
            'desc' => $this->desc,
            'code' => $this->code,
            'status' => $this->status,
            'start_date' => date("Y-m-d", strtotime($this->start_date)),
            'end_date' => date("Y-m-d", strtotime($this->end_date)),
            'created_at' => date("Y-m-d H:i:s", strtotime($this->created_at)),
            'updated_at' => date("Y-m-d H:i:s", strtotime($this->updated_at))
        ];
    }
}
