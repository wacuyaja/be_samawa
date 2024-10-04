<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookingTransactionRequest;
use App\Http\Resources\Api\WeddingTransactionResource;
use App\Models\WeddingPackageModel;
use App\Models\WeddingTransactionModel;
use Illuminate\Http\Request;

class BookingTransactionController extends Controller
{
    public function store(StoreBookingTransactionRequest $request) {
        $validatedData = $request->validated();
        $weddingPackage = WeddingPackageModel::find($validatedData['wedding_package_id']);

        if(!$weddingPackage) {
            return response()->json(['message' => 'Wedding package not found'], 404);
        }

        if($request->hasFile('proof')) {
            $filePath = $request->file('proof')->store('transactions-proof', 'public');
            $validatedData['proof'] = $filePath;
        }


        $price = $weddingPackage->price;
        $total_tax_amount = $price * 0.11;
        $total_amount = $price + $total_tax_amount;
        $validatedData['price'] = $price;
        $validatedData['total_tax_amount'] = $total_tax_amount;
        $validatedData['total_amount'] = $total_amount;



        $validatedData['is_paid'] = false;
        $validatedData['booking_trx_id'] = WeddingTransactionModel::generateUniqueTrxId();

        $bookingTransaction = WeddingTransactionModel::create($validatedData);
        $bookingTransaction->load('weddingPackage');

        return new WeddingTransactionResource($bookingTransaction);
    }

    public function bookingDetails(Request $request) {
        $request->validate([
            'phone' => 'required|string',
            'booking_trx_id' => 'required|string'
        ]);

        $booking = WeddingTransactionModel::where('phone', $request->phone)
        ->where('booking_trx_id', $request->booking_trx_id)
        ->with([
            'weddingPackage',
            'weddingPackage.city' => function($query) {
                $query->withCount('weddingPackages');
            },
            'weddingPackage.weddingBonusPackages.bonusPackage',
            'weddingPackage.weddingOrganizer' => function($query) {
                $query->withCount('weddingPackages');
            }
        ])
        ->first();

        if(!$booking) {
            return response()->json(['message'=> 'booking not found'], 404);
        }

        return new WeddingTransactionResource($booking);
    }
}
