<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //Allow to fill product data
    protected $fillable = ['name', 'description', 'price'];
}
