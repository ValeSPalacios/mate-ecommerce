<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class ProductProvider extends Model
{
    use HasFactory;
    protected $table='product_provider';
    protected $fillable=[
        'product_id',
        'provider_id',
    ];
    protected $hidden=['created_at','updated_at'];

    
}
