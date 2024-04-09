<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tier extends Model
{
    use HasFactory;

    protected $table = "tiers";
    protected $primaryKey = "tier_id";


    protected $fillable=[
        'tier_name'
    ];


    public function prices()
    {
        return $this->belongsTo(CakeSizeWithPrice::class, 'tier_id');
    }
}
