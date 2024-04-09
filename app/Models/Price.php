<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;
    protected $table = "price";
    protected $primaryKey = "price_id";


    protected $fillable=[
        'price_value'
    ];
}
