<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StatusResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'body' => $this->body,
            'user_name' => $this->user->name,
            // 'user_avatar' => $this->user->avatar,
            'user_avatar' => 'https://www.pmfarma.es/images/avatar-equipo.png',
            'ago' => $this->created_at->diffForHumans(),
        ];
    }
}
