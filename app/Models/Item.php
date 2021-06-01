<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable=['restaurant_id','category_id','tax_id','name','details','price','discount_to','discount','discount_type','status','image'];

    public function user(){
        return $this->belongsTo(User::class)->withDefault();
    }
    public function restaurant(){
        return $this->belongsTo(Restaurant::class)->withDefault();
    }
    public function category(){
        return $this->belongsTo(Category::class)->withDefault();
    }
    public function extras(){
        return $this->hasMany(ItemExtra::class);
    }
    public function active_extras(){
        return $this->extras()->where('status','active');
    }
    public function tax(){
        return $this->belongsTo(Tax::class)->withDefault();
    }

}
