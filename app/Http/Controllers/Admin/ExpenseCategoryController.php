<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin\ExpenseCategory;
use App\Traits\ResponseTraits;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ExpenseCategoryController extends Controller
{
    use ResponseTraits;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!(checkUserPermission('expense_category'))) {
            return redirect('admin/dashboard')->withMessage('Unauthorized Access');
        }
        $branch_id = $this->getBranchId();
        $expense_categorys = ExpenseCategory::when($branch_id, function ($query,$branch_id) {
                                $query->where('branch_id',$branch_id);
                            })->orderBy('id', 'desc')->get();

        return view('Admin.expense-category', compact('expense_categorys'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if (!(checkUserPermission('expense_category_create'))) {
            return view('Helper.unauthorized_access');
        }
        $expense_category = null;
        return view('Admin.Model.expense_categorymodel', compact('expense_category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'expense_category_name' => [
                                            'required',
                                            Rule::unique('expense_categories')
                                            ->ignore($request->uuid,'uuid')
                                            ->whereNull('deleted_at')
                                            ->where(function ($query) use ($request){
                                                return $query->where('branch_id',  $request->branch_id);
                                            })
                                        ],
            // 'expense_category_name' => 'unique:categories,expense_category_name,NULL,'. $request->uuid.',deleted_at,NULL',
            'branch_id' => 'required',
        ]);

        if ($validation->fails()) {
            return $this->sendResponse(0, '', $validation->errors(), '');
        }

        if ($request->uuid) {
            if (!(checkUserPermission('expense_category_edit'))) {
                return $this->sendResponse(1, config('constant.UNAUTHORIZED_ACCESS'), '', url('admin/expense-category'));
            }

            ExpenseCategory::where('uuid', $request->uuid)->update([
                'expense_category_name' => $request->expense_category_name,
                'expense_category_slug' => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->expense_category_name))),
                'branch_id' => $request->branch_id,
            ]);
            return $this->sendResponse(1, 'Expense Category Updated', '', '');
        } else {

            if (!(checkUserPermission('expense_category_create'))) {
                return $this->sendResponse(1, config('constant.UNAUTHORIZED_ACCESS'), '', url('admin/expense-category'));
            }

            ExpenseCategory::create([
                'expense_category_name' => $request->expense_category_name,
                'expense_category_slug' => strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->expense_category_name))),
                'branch_id' => $request->branch_id,
                'uuid' => Str::uuid(),
            ]);
            return $this->sendResponse(1, 'Expense Category Created', '', '');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExpenseCategory $expense_category, Request $request)
    {
        if (!(checkUserPermission('expense_category_edit'))) {
            return view('Helper.unauthorized_access');;
        }
        return view('Admin.Model.expense_categorymodel', compact('expense_category'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExpenseCategory $expense_category)
    {
        if (!(checkUserPermission('expense_category_delete'))) {
            return $this->sendResponse(1, config('constant.UNAUTHORIZED_ACCESS'), '', url('admin/expense-category'));
        }
        $result = $expense_category->delete();
        if ($result) {
            return $this->sendResponse(1, 'Expense Category Deleted succussfully', '', url('admin/expense-category'));
        } else {
            return $this->sendResponse(1, 'Something Went Wrong! please try again.', '', url('admin/expense-category'));
        }
    }
}
