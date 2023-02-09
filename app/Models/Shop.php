<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Service;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'shop_name', 
        'building_number', 
        'street', 
        'barangay',
        'formatted_address',
        // 'city', 
        // 'province', 
        'zipcode',
        'location',
    ];

}
