<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WeddingPhotoModel extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'wedding_photo';
    protected $fillable = [
        'wedding_package_id',
        'photo'
    ];
}
