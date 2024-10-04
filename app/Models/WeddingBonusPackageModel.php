<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class WeddingBonusPackageModel extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'wedding_bonus_package';
    protected $fillable = [
        'wedding_package_id',
        'bonus_package_id'
    ];

    public function weddingPackage() : BelongsTo {
        return $this->belongsTo(WeddingPackageModel::class, 'wedding_package_id');
    }

    public function bonusPackage() : BelongsTo {
        return $this->belongsTo(BonusPackageModel::class, 'bonus_package_id');
    }
}
