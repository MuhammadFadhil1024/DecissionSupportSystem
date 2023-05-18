<?php

namespace App\Models;

use App\Models\Criteria;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'description'
    ];

    public function criteria()
    {
        return $this->hasMany(Criteria::class, 'categories_id', 'id');
    }

    public function alternatives()
    {
        return $this->hasMany(Alternative::class, 'categories_id', 'id');
    }
}
