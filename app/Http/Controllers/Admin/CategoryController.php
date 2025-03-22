<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Traits\ResponseTraits;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    use ResponseTraits;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if(!(checkUserPermission('category')))
        {
            return redirect('admin/dashboard')->withMessage('Unauthorized Access');
        }
        $branch_id = $this->getBranchId();

        $categorys = Category::when($branch_id, function ($query,$branch_id) {
                        $query->where('branch_id',$branch_id);
                    })->orderBy('id', 'desc')->get();
        return view('Admin.category',compact('categorys'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if(!(checkUserPermission('category_create')))
        {
            return view('Helper.unauthorized_access');
        }
        $category = null;
        return view('Admin.Model.categorymodel',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'category_name' =>  [   'required',
                                    Rule::unique('categories')
                                    ->ignore($request->uuid,'uuid')
                                    ->whereNull('deleted_at')
                                    ->where(function ($query) use ($request){
                                        return $query->where('branch_id',  $request->branch_id);
                                    })
                                ],
            // 'category_name' => 'unique:categories,category_name,NULL,'. $request->uuid.',deleted_at,NULL',
            'branch_id' => 'required',
        ]);

        if($validation->fails())
        {
            return $this->sendResponse(0,'',$validation->errors(),'');
        }

        if($request->uuid)
        {
            if(!(checkUserPermission('category_edit')))
            {
                return $this->sendResponse(1,config('constant.UNAUTHORIZED_ACCESS'),'',url('admin/category'));
            }

            Category::where('uuid',$request->uuid)->update([
                'category_name' => $request->category_name,
                'other_name' => $request->category_other_name,
                'category_slug' => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->category_name))),
                'branch_id' => $request->branch_id,
            ]);
            return $this->sendResponse(1,'Category Updated','','');
        }else{

            if(!(checkUserPermission('category_create')))
            {
                return $this->sendResponse(1,config('constant.UNAUTHORIZED_ACCESS'),'',url('admin/category'));
            }

            Category::create([
                'category_name' => $request->category_name,
                'other_name' => $request->category_other_name,
                'category_slug' => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->category_name))),
                'branch_id' => $request->branch_id,
                'uuid' => Str::uuid(),
            ]);
            return $this->sendResponse(1,'Category Created','','');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category, Request $request)
    {
        if(!(checkUserPermission('category_edit')))
        {
            return view('Helper.unauthorized_access');;
        }
        return view('Admin.Model.categorymodel',compact('category'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if(!(checkUserPermission('category_delete')))
        {
            return $this->sendResponse(1,config('constant.UNAUTHORIZED_ACCESS'),'',url('admin/category'));
        }
        $result = $category->delete();
        if($result){
            return $this->sendResponse(1,'Category Deleted succussfully','',url('admin/category'));
        }else{
            return $this->sendResponse(1,'Something Went Wrong! please try again.','',url('admin/category'));
        }
    }
}
