<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Size;
use App\Models\Tier;


class CakeSizeWithPrice extends Model
{
    use HasFactory;


    protected $table = "cake_size_with_prices";
    protected $primaryKey = "id";



    protected $fillable=[
        'tier_id',
        'size_id',
        'price'
    ];


    public function tier()
    {
        return $this->hasMany(Tier::class, 'tier_id','tier_id');
    }

    public function size()
    {
        return $this->hasMany(Size::class, 'size_id','size_id');
    }
}
