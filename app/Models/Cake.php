<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubCategory;
use App\Models\Tag;
use App\Models\CakeSizeWithPrice;
use App\Models\Flavor_With_Price;

class Cake extends Model
{
    use HasFactory;

    protected $table = "cakes";
    protected $primaryKey = "id";


    public $fillable = [
      'cakename',
      'productId',
      'category_name',
      'images',
      'discount',
      'subcategory_ids',
     'tag_ids',
     'cake_size_with_prices_ids',
     'flavor_with_prices_ids'
      
    ];



    // public function subcategory(){


    //   return $this->belongsToMany(SubCategory::class);
    // }

    // public function tags(){


    //   return $this->belongsToMany(Tag::class,"cake_details_merges","tag_id","tag_id");
    // }


    // public function getcakesizewithprice(){


    //   return $this->belongsToMany(CakeSizeWithPrice::class,"cake_details_merges","cake_size_with_prices_id","cake_size_with_prices_id");
    // }

    // public function getflavorwithprice(){


    //   return $this->belongsToMany(Flavor_With_Price::class,"cake_details_merges","flavor_with_prices_id","flavor_with_prices_id");
    // }

 
}
