<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sales extends Model
{
    use HasFactory;
    protected $table='sales';
    protected $fillable=[
        'user_id',
        'total'
        
    ];
    protected $hidden=['deleted_at','created_at','updated_at'];

    public function details():HasMany{

        return $this->hasMany(SalesDetails::class,'sale_id','id');
    }
}