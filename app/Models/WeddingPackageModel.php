<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class WeddingPackageModel extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'wedding_package';
    protected $fillable = [
        'name',
        'slug',
        'thumbnail',
        'about',
        'price',
        'is_popular',
        'city_id',
        'wedding_organizer_id'
    ];

    public function setNameAttribute($value) {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function city() : BelongsTo {
        return $this->belongsTo(CityModel::class, 'city_id');
    }

    public function weddingOrganizer() : BelongsTo {
        return $this->belongsTo(WeddingOrganizerModel::class, 'wedding_organizer_id');
    }

    public function photos() : HasMany {
        return $this->hasMany(WeddingPhotoModel::class, 'wedding_package_id');
    }

    public function weddingBonusPackages() : HasMany {
        return $this->hasMany(WeddingBonusPackageModel::class, 'wedding_package_id');
    }

    public function weddingTestimonials() : HasMany {
        return $this->hasMany(WeddingTestimonialModel::class, 'wedding_package_id');
    }
}
