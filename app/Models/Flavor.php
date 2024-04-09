<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flavor extends Model
{
    use HasFactory;


    protected $table = "flavor";
    protected $primaryKey = "flavor_id";

    
    protected $fillable=[

        "flavor_name",
        "flavor_description",
        "flavor_ingredients",
        "flavor_image"

    ];

   

    public function prices()
    {
        return $this->belongsTo(Flavor_with_price::class, 'flavor_id');
    }

}
