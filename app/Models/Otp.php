<?php

namespace App\Models;

use App\Enums\BloodType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Otp extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [];
}
