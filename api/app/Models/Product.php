<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table="product";
    protected $primaryKey="id";
    protected $fillable=["name","cate_id","price","discount","img","maxPrice","minPrice","status"];
    public function getCategory(){
        return $this->belongsTo(Category::class,'cate_id','id');
    }
}
