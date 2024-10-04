<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class WeddingOrganizerModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'wedding_organizer';
    protected $fillable = [
        'name',
        'slug',
        'icon',
        'phone',
    ];

    public function setNameAttribute($value) {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function weddingPackages() : HasMany {
        return $this->hasMany(WeddingPackageModel::class, 'wedding_organizer_id');
    }
}
