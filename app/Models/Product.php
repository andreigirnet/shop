<?php

namespace App\Models;

use Gloudemans\Shoppingcart\Contracts\Buyable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;


class Product extends Model
{
    use Searchable;
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'name',
        'slug',
        'details',
        'price',
        'description',
        'quantity'
    ];
    protected $guarded = ['id'];




     public function presentPrice(){
         setlocale(LC_MONETARY, 'en_US');
         return '$' .  number_format($this->price/100, 2, '.', '');
    }
    public function categories(){
        return $this->belongsToMany(Category::class);
    }
    public function orders(){
        return $this->belongsToMany(Order::class)->withPivot('quantity');
    }
    public function toSearchableArray(){
         $array = $this->toArray();
         $extraFields = [
             'categories' =>$this->categories->pluck('name')->toArray(),
         ];
         return array_merge($array,$extraFields);
    }
}
