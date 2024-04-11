<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;


    protected $table = "tag";
    protected $primaryKey = "tag_id";


    protected $fillable=[
        'tag_name'
    ];

    public function cake(){
        return $this->belongsToMany(Cake::class,"cake_details_merges");
      }

}
