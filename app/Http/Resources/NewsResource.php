<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
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
            'title' => $this->title,
            'image' => asset('storage/'.$this->image),
            'content' => $this->content,
            'status' => $this->status,
            'created_at' => date("Y-m-d H:i:s", strtotime($this->created_at)),
            'updated_at' => date("Y-m-d H:i:s", strtotime($this->updated_at)),
        ];
    }
}
