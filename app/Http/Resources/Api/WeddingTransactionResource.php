<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WeddingTransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'bookingTrxId' => $this->booking_trx_id,
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'proof' => $this->proof,
            'totalAmount' => $this->total_amount,
            'price' => $this->price,
            'totalTaxAmount' => $this->total_tax_amount,
            'isPaid' => $this->is_paid,
            'startedAt' => $this->started_at,
            'weddingPackage' => new WeddingPackageResource($this->whenLoaded('weddingPackage'))
        ];
    }
}
