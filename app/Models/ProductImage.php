<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;

    // /* protected $fillable = ['id', 'product_color_size_id', 'image', 'created_at', 'updated_at']; */
    protected $fillable = ['id', 'product_id', 'image'];
    protected $table = 'product_images';

    public function productColorSize () {
        // /* return $this->belongsTo(ProductColorSize::class); */
        return $this->belongsTo(Product::class);
    }
}
