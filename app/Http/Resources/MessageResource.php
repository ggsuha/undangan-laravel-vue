<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
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
            'name' => $this->name,
            'confirm' => $this->confirm,
            'message' => $this->message,
            'created_at' => $this->created_at->translatedFormat('d F Y, H:i') . ' ' . $this->created_at->format('T')
        ];
    }
}
