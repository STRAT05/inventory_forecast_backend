<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'purchases',
        'image', // Added image to fillable attributes
        'average_weekly_sales',
        'lead_time',
    ];
}
