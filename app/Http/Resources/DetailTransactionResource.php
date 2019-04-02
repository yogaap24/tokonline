<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DetailTransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'id' => $this->id,
            'product_id' => $this->product_id,
            'product' => ucfirst($this->product),
            'qty' => (int)$this->qty,
            'price' => "Rp ".number_format($this->price),
            'total' => "RP ".number_format($this->total),
        ];
    }
}
