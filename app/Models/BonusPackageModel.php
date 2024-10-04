<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class BonusPackageModel extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'bonus_package';
    protected $fillable = [
        'name',
        'slug',
        'thumbnail',
        'about',
        'price'
    ];

    public function setNameAttribute($value) {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
}
