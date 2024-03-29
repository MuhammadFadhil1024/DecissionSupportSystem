<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'alternatives_id', 'result'
    ];

    public function alternatives()
    {
        return $this->BelongsTo(Alternative::class, 'alternatives_id', 'id');
    }
}
