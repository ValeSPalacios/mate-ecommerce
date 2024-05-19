<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SalesDetails extends Model
{
    use HasFactory;
    protected $table='sales_details';
    protected $fillable=[
        'sale_id',
        'product_id',
        'quantity',
        'sale_price',
        'increase'
        
    ];
    protected $hidden=['deleted_at','created_at','updated_at'];

    public function sale():BelongsTo{

        return $this->belongsTo(Sales::class,'sale_id','id');
    }

    public function product():BelongsTo{

        return $this->belongsTo(Product::class,'product_id','id');
    }
}