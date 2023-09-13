<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Products\ProductDeleteRequest;
use Illuminate\Http\Request;
use App\Http\Requests\Dashboard\Products\StoreProductRequest;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use App\Services\CategoryService;
use App\Services\ProductService;

class ProductController extends Controller
{
    public CategoryService $categoryService;
    public ProductService $productService;

    public function __construct(CategoryService $categoryService, ProductService $productService)
    {
        $this->categoryService = $categoryService;
        $this->productService = $productService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.products.index');
    }

    public function getall(Request $request)
    {
       return $this->productService->datatable();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->categoryService->getAll();
        return view('dashboard.products.create' , compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */ 
    public function store(StoreProductRequest $request)
    {
        // dd($request->all());
        $product = $this->productService->store($request->validated());
        return redirect()->route('dashboard.products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = $this->categoryService->getAll();
        $product = $this->productService->getById($id);
        return view('dashboard.products.edit' , compact('categories', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->productService->update($id,$request->all());
        return redirect()->route('dashboard.products.index');
    }

    public function delete(ProductDeleteRequest $request) {
        // dd($request->all());
        /* Category::whereId($request->id)->delete(); */
        $this->productService->delete($request->validated());
        return redirect()->route('dashboard.products.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
