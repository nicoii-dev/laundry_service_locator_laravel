<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'shop_name', 
        'house_number', 
        'street', 
        'barangay',
        // 'city', 
        // 'province', 
        'formatted_address',
        'zipcode',
        'location',
    ];
}
