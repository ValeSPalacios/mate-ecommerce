<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table="Categories";
    protected $fillable=[
        'name'
    ];
    protected $hidden=['deleted_at','created_at','updated_at'];
}
