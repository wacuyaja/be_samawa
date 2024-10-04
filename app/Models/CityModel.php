<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class CityModel extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'city';
    protected $fillable = [
        'name',
        'slug',
        'icon',
    ];

    public function setNameAttribute($value) {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function weddingPackages() : HasMany {
        return $this->hasMany(WeddingPackageModel::class, 'city_id');
    }
}
