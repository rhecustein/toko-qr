<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemExtra extends Model
{
    use HasFactory;
    protected $fillable=['title','price','status'];
}
