<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class value extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'alternative_id', 'criteria_id', 'value', 'normalization', 'prefrensi'
    ];

    public function criterias()
    {
        return $this->belongsTo(Criteria::class, 'criteria_id', 'id');
    }
}
