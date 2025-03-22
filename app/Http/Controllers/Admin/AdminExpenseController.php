<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\ResponseTraits;
use App\Http\Controllers\Controller;
use App\Models\Expense;
use Illuminate\Support\Facades\Validator;

class AdminExpenseController extends Controller
{
    use ResponseTraits;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $from_date = (isset($request->from_date) && $request->from_date != '') ? $request->from_date." 00:00:00" : date('Y-m-d 00:00:00');
        $to_date = (isset($request->to_date) && $request->to_date != '') ? $request->to_date." 23:59:59" : date('Y-m-d 23:59:59');
        if(!(checkUserPermission('expenses')))
        {
            return redirect('admin/dashboard')->withMessage('Unauthorized Access');
        }
        $branch_id = $this->getBranchId();
        $expenses = Expense::when($branch_id, function ($query,$branch_id) {
                        $query->where('branch_id',$branch_id);
                    })->whereBetween('created_at', [$from_date, $to_date])->orderBy('id', 'desc')->get();

        return view('Admin.expense',compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if(!(checkUserPermission('expense_create')))
        {
            return view('Helper.unauthorized_access');
        }
        $expense = null;
        return view('Admin.Model.expensemodel',compact('expense'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'branch_id' => 'required',
            'expense_category' => 'required',
            //'tot_bf_vat' => 'required',
            //'vat_amt' => 'required',
            'amount' => 'required',
        ],[
           // 'tot_bf_vat.*' => 'Total Before Vat required',
           // 'vat_amt.*' => 'Vat required',
            'amount.*' => 'Final Amount required',
            'expense_category.*' => 'Expense Category required',
        ]);

        if($validation->fails())
        {
            return $this->sendResponse(0,'',$validation->errors(),'');
        }

        if($request->uuid)
        {
            if(!(checkUserPermission('expense_edit')))
            {
                return $this->sendResponse(1,config('constant.UNAUTHORIZED_ACCESS'),'',url('admin/expense'));
            }

            Expense::where('uuid',$request->uuid)->update([
                'expense_cat_id' => $request->expense_category,
                'expense_cat_name' => expenseCatByID($request->expense_category)->expense_category_name,
                'invoice_no' => $request->invoice_no,
                'description' => $request->description,
                'total_before_vat' => $request->tot_bf_vat,
                'vat' => $request->vat_amt,
                'total_amount' => $request->amount,
                'payment_status' => $request->payment_status,

            ]);
            return $this->sendResponse(1,'Expense Updated','','');
        }else{

            if(!(checkUserPermission('expense_create')))
            {
                return $this->sendResponse(1,config('constant.UNAUTHORIZED_ACCESS'),'',url('admin/expense'));
            }

            Expense::create([
                'expense_cat_id' => $request->expense_category,
                'expense_cat_name' => expenseCatByID($request->expense_category)->expense_category_name,
                'invoice_no' => $request->invoice_no,
                'description' => $request->description,
                'total_before_vat' => $request->tot_bf_vat,
                'vat' => $request->vat_amt,
                'total_amount' => $request->amount,
                'action' => 'Admin',
                'payment_status' => $request->payment_status,
                'user_id' => auth()->user()->id,
                'branch_id' => $request->branch_id,
                'uuid' => Str::uuid(),
            ]);
            return $this->sendResponse(1,'Expense Created','','');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense, Request $request)
    {
        if(!(checkUserPermission('expense_edit')))
        {
            return view('Helper.unauthorized_access');;
        }
        return view('Admin.Model.expensemodel',compact('expense'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        if(!(checkUserPermission('expense_delete')))
        {
            return $this->sendResponse(1,config('constant.UNAUTHORIZED_ACCESS'),'',url('admin/expense'));
        }
        $result = $expense->delete();
        if($result){
            return $this->sendResponse(1,'Expense Deleted succussfully','',url('admin/expense'));
        }else{
            return $this->sendResponse(1,'Something Went Wrong! please try again.','',url('admin/expense'));
        }
    }
}
