<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cake;

class SubCategory extends Model
{
    use HasFactory;


    protected $table = "subcategories";
    protected $primaryKey = "subcategory_id";


    protected $fillable=[
        'subcategory_name',
        'category'
    ];

    public function cake(){
        return $this->belongsToMany(Cake::class,"cake_details_merges");
      }
}
