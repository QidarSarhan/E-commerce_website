<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductImage;
use App\Utils\ImageUpload;
use Yajra\DataTables\Facades\DataTables; 

class ProductRepository implements RepositoryInterface
{
    public $product;
    /* public $category; */
    public function __construct(Product $product, /* Category $category */)
    {
        $this->product = $product;
        /* $this->category = $category; */
    }

    public function baseQuery($relations=[], $withCount=[])
    {
        $query = $this->product->select('*')->with($relations);
        foreach ($withCount as $key => $value) {
           $query->withCount($value);
        }
        return $query;
    }

    public function getbyId($id)
    {
        return $this->product->where('id', $id)->firstOrFail();
    }


    public function store($params)
    {
        $product =  $this->product->create($params);
        
        $images = $this->uploadMultipleImages($params , $product);
        $product->images()->createMany($images);
        return $product;

        /* return $this->product->create($params); */
        // $product = $this->product->create($params);
        // $images = $this->uploadMultipleImages($params, $product);
        // /* $images = [];
        // if(isset($params['images'])) {
        //     $i = 0;
        //     foreach ($params['images'] as $key => $value) {
        //         $images[$i]['image'] = ImageUpload::uploadImage($value);
        //         $images[$i]['product_id'] = $product->id;
        //         $i++;
        //     }
        // } */
        // dd($images);
        // $product->images()->createMany($images); 
        // return $product;
    }

    private function uploadMultipleImages($params, $product) 
    {
        // dd($params)
        // dd($product);
        $images = [];
        if(isset($params['images'])) {
            $i = 0;
            foreach ($params['images'] as $key => $value) {
                // dd($value);
                $images[$i]['image'] = ImageUpload::uploadImage($value);
                $images[$i]['product_id'] = $product->id;
                $i++;
            }
        }
        // dd($images);
        // /* $product->images()->createMany($images); */ 
        return $images;
    }

    public function addColor($product, $params)
    {
        $product->productColor()->createMany($params['colors']);

    }

    public function update($id, $params)
    {
        // dd($params);
        $product = $this->getbyId($id);
        // /* $id = $product; */
        /* return $product->update($params); */
        // $product = tap($product->update($params));
        $product =($product->update($params));
        // dd($product);
        $product = $this->getbyId($id);
        $images = $this->uploadMultipleImages($params, $product);
        // dd($images);
        $product->images()->createMany($images);
        return $product;
    }

    public function delete($params)
    {
        $product = $this->getbyId($params['id']);
        return $product->delete();
    }
}