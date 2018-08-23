<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ProxyResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $this
     * @return array
     */
    public function toArray($request)
    {
//        return parent::toArray($this);
        return [
            'id' => $this->id,
            'ip' => $this->ip,
            'port' => $this->port,
            'ssl' => $this->ssl,
            'country' => $this->country,
            'anonim' => $this->anonim,
            'availablity' => $this->availablity,
            'latency' => $this->latency,
        ];
    }
}
