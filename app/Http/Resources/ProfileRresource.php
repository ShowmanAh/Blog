<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileRresource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'user_id' => $this->user,
            'avatar'=>$this->avatar,
            'about'=>$this->about,
            'facebook'=>$this->facebook,
            'youtube'=>$this->youtube
        ];
       // return parent::toArray($request);
    }
}
