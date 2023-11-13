<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'number' => $this->number,
            'user_id' => $this->user_id,
            'user_name' => $this->user->name,
            'level_id' => $this->level_id,
            'level_name' => $this->level->name,
            'total' => $this->total,
            'total_discount' => $this->total_discount,
            'amount' => $this->amount,
            'final_total' => $this->final_total,
            'status' => $this->status,
            'remark' => $this->remark,
            'order_detail' => $this->orderDetail,
            'paid_at' => date("Y-m-d H:i:s", strtotime($this->paid_at)),
            'refund_at' => $this->refund_at == null ? "" : date("Y-m-d H:i:s", strtotime($this->refund_at)),
            'created_at' => date("Y-m-d H:i:s", strtotime($this->created_at)),
            'updated_at' => date("Y-m-d H:i:s", strtotime($this->updated_at)),
        ];
    }
}
