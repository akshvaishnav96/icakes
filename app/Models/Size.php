<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CakeSizeWithPrice;

class Size extends Model
{
    use HasFactory;

    protected $table = "size";
    protected $primaryKey = "size_id";


    protected $fillable=[
        'size_name',
        'description'
        
    ];

    public function price()
    {
        return $this->belongsTo(CakeSizeWithPrice::class, 'size_id');
    }
}
