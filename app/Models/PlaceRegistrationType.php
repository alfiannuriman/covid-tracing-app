<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlaceRegistrationType extends Model
{
    const STATUS_CHECK_IN = 1;
    const STATUS_CHECK_OUT = 2;
}
