<?php

namespace App\Services;

use App\Models\Category;
use App\Repositories\CategoryRepository;
use App\Utils\ImageUpload;
use Yajra\DataTables\Facades\DataTables;

class CategoryService
{
    public $categoryRepository;
    public function __construct(CategoryRepository $repo)
    {
        $this->categoryRepository = $repo;

    }
    public function getMainCategories()
    {
        return $this->categoryRepository->getMainCategories();
        // return Category::where('parent_id', 0)->orWhere('parent_id', null)->get();
        // return Category::where('parent_id', 0)->orWhereNull('parent_id')->get();
    }


    public function store($params)
    {
        $params['parent_id'] = $params['parent_id'] ?? 0;
        if(isset($params['image'])){
            $params['image'] = ImageUpload::uploadImage($params['image']);
        }
        // dd($params);
        // return Category::create($params);
        return $this->categoryRepository->store($params);
    }

    public function getById($id, $childrenCount = false)
    {
        // return Category::firstOrFail($id);
        /* $query = Category::where('id', $id);
        if($childrenCount){
            $query->withCount('child');
        } */
        // return $query->firstOrFail();

        return $this->categoryRepository->getById($id, $childrenCount);
    }

    public function update($id, $params)
    {
        // dd($params);
        // $category = $this->getById($id);
        $category = $this->categoryRepository->getById($id);
        $params['parent_id'] = $params['parent_id'] ?? 0;
        if(isset($params['image'])){
            $params['image'] = ImageUpload::uploadImage($params['image']);
        }
        // dd($params);
        // return $category->update($params);
        return $this->categoryRepository->update($category, $params);

    }

    

    /* public function getByIdForEdit($id)
    {
        return Category::where('id', $id)->withCount('child')->firstOrFail();
    } */

    public function delete($params)
    {
        $this->categoryRepository->delete($params);
    }

    public function datatable()
    {
        // /* $query = Category::select('*')->with('parent'); */
        $query = $this->categoryRepository->baseQuery(['parent']);
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
                // dd($row->parent);
                // return ($row->parent ==  0) ? 'قسم رئيسي' :   $row->parents->name;
            })

            ->addColumn('image', function ($row) {
                return '<img src="' . asset($row->image) . '" width="100px" height="100px">';
            })

            ->rawColumns(['parent', 'action', 'image'])
            ->make(true);
    }

    public function getAll()
    {
        return $this->categoryRepository->baseQuery(['child'])->get();
    }

}