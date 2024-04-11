<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Flavor;

class Flavor_With_Price extends Model
{
    use HasFactory;

    protected $table = "flavor__with__prices";
    protected $primaryKey = "flavor_with_prices_id";

    protected $fillable= [
        'flavor_id',
        'flavor_price'
    ];


  
    public function flavor()
    {
        return $this->hasMany(Flavor::class, 'flavor_id','flavor_id');
    }

    public function cake(){
        return $this->belongsToMany(Cake::class,"cake_details_merges");
      }

    

}
