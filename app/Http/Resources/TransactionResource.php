<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\DetailTransactionResource;

class TransactionResource extends JsonResource
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
            'transaction_code' => $this->transaction_code,
            'user' => $this->userRelation->name,
            'resi_code' => $this->resi_code,
            'grandtotal' => "Rp ".number_format($this->grandtotal,0,'.','.'),
            'destination' => $this->destination,
            'kurir' => $this->kurir,
            'date_transactions' => $this->date_transactions->format('d-m-Y'),
            'status_transaction' => $this->status_payment,
            'detail_transaction' => DetailTransactionResource::collection($this->whenLoaded('detailRelation')),
        ];
    }
}
