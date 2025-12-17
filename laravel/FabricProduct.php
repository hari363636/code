<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContracts;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class FabricProduct extends Model implements TranslatableContracts
{
    use HasFactory, Translatable, SoftDeletes;

    protected $guarded = ['id'];
    protected $table = "fabric_products";
    protected $fillable = [
        'name',
        'name_arabic',
        'category_id',
        'vendor_id',
		'brand_id',
        'price',
        'image',
        'gallery_images',
        'description',
        'description_arabic',
        'stock',
        'created_at',
        'updated_at',
        'deleted_at',
        'status'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:s:i',
        'updated_at' => 'datetime:Y-m-d H:s:i'
    ];

    public $translatedAttributes = ['name','description'];


public function vendor()
{
   return $this->hasone(User::class,'id','vendor_id')->select('id','name','email');
}



public function sale()
{
  return $this->belongsTo(Order::class,'product_id');
}

	

public function category() {
    return $this->belongsTo(FabricCategory::class, 'category_id','id');
}



public function store(){
    return $this->belongsTo(User::class,'vendor_id','id');

}




public function carts()
{
    return $this->belongsToMany(Cart::class);
}



public function Controller(Posts $post)
{
  $post->update(['created_at' => Carbon::today()->toDateTimeString()]);
  $post->update(['updated_at' => Carbon::today()->toDateTimeString()]);
}
}
