<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class District extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function shop(): BelongsTo {
        return $this->belongsTo(Division::class);
    }
}
