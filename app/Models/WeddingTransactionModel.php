<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class WeddingTransactionModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'wedding_transaction';
    protected $fillable = [
        'booking_trx_id',
        'name',
        'phone',
        'email',
        'proof',
        'total_amount',
        'price',
        'total_tax_amount',
        'is_paid',
        'started_at',
        'wedding_package_id'
    ];

    public function weddingPackage() : BelongsTo {
        return $this->belongsTo(WeddingPackageModel::class, 'wedding_package_id');
    }

    public static function generateUniqueTrxId() {
        $prefix = 'SMBWA';
        do {
            $randomString = $prefix . mt_rand(1000, 9999);
        } while(self::where('booking_trx_id', $randomString)->exists());

        return $randomString;
    }
}
