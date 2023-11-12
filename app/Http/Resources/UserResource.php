<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'account' => $this->account,
            'email' => $this->email,
            'refcode' => $this->refcode,
            'phone' => $this->phone,
            'status' => $this->status,
            'gender' => $this->gender,
            'birth' => date("Y-m-d", strtotime($this->birth)),
            'level_id' => $this->level_id,
            'level_name' => $this->level->name,
            'address' => $this->address,
            'created_at' => date("Y-m-d H:i:s", strtotime($this->created_at)),
            'updated_at' => date("Y-m-d H:i:s", strtotime($this->updated_at))
        ];
    }
}
