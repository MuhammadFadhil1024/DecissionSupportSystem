<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alternative extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'categories_id', 'alternative_code', 'name'
    ];

    public function values(): HasMany
    {
        return $this->hasMany(value::class, 'alternative_id', 'id');
    }

    public function result(): HasOne
    {
        return $this->hasOne(Result::class, 'alternatives_id', 'id');
    }
}
