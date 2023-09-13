<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Categories\CategoryDeleteRequest;
use App\Http\Requests\Dashboard\Categories\CategoryStoreRequest;
use App\Http\Requests\Dashboard\Categories\CategoryUpdateRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
// use DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private $categoryService;

    // create constructor to bind CategoryService class
    public function __construct(CategoryService $categoryService) 
    {
        $this->categoryService = $categoryService;
    }


    public function index()
    {
        //
        // $mainCategories = Category::whare('parent_id', 0)->orWhere('parent_id', null)->get();
        
        // $mainCategories = Category::where('parent_id', 0)->orWhereNull('parent_id')->get();
        // $mainCategories = app(CategoryService::class)->getMainCategories();
        $mainCategories = $this->categoryService->getMainCategories();
        // $categories = Category::paginate(10);
        // return view('dashboard.categories.index', compact('mainCategories', 'categories')); 
        return view('dashboard.categories.index', compact('mainCategories'));
       
    }


    public function getall()
    {
        return $this->categoryService->datatable();
        /* $query = Category::select('*')->with('parent');
        return  DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return $btn = '
                        <a href="' . Route('dashboard.categories.edit', $row->id) . '"  class="edit btn btn-success btn-sm" ><i class="fa fa-edit"></i></a>

                        <button type="button" id="deleteBtn"  data-id="' . $row->id . '" class="btn btn-danger mt-md-0 mt-2" data-bs-toggle="modal"
                        data-original-title="test" data-bs-target="#deletemodal"><i class="fa fa-trash"></i></button>';
            })

            ->addColumn('parent', function ($row) {
                if ($row->parent) {
                    return $row->parent->name;
                }
                return 'قسم رئيسي';

                // return ($row->parent ==  0) ? 'قسم رئيسي' :   $row->parents->name;
            })

            ->addColumn('image', function ($row) {
                return '<img src="' . asset($row->image) . '" width="100px" height="100px">';
            })

            ->rawColumns(['parent', 'action', 'image'])
            ->make(true); */

    }
    

    /**
     * Show the form for creating a new resource.
     */
    /* public function create()
    {
        //
    } */

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request)
    {
        // dd($request->all());
        $this->categoryService->store($request->validated());
        return redirect()->route('dashboard.categories.index')->with('success', 'تمة الاضافة بنجاح');
    }

    /**
     * Display the specified resource.
     */
    /* public function show(string $id)
    {
        //
    } */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // dd($id);
        $category = $this->categoryService->getById($id, true);
        $mainCategories = $this->categoryService->getMainCategories();
        return view('dashboard.categories.edit', compact('category', 'mainCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $id, CategoryUpdateRequest $request)
    {
        // dd($request->all());
        $this->categoryService->update($id,$request->validated());
        return redirect()->route('dashboard.categories.edit', $id)->with('update success', 'تم التحديث بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    /* public function destroy(string $id)
    {
        //
    } */

    public function delete(CategoryDeleteRequest $request) {
        // dd($request->all());
        /* Category::whereId($request->id)->delete(); */
        $this->categoryService->delete($request->validated());
        return redirect()->route('dashboard.categories.index');

    }
}
