<?php

namespace App\Http\Controllers\Counter;

use App\Events\PaymentTransactionEvent;
use App\Models\Expense;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\ResponseTraits;
use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Validator;

class ExpenseController extends Controller
{
    use ResponseTraits;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!(checkUserPermission('expense')))
        {
            return view('Helper.unauthorized_access');
        }
        $expense = null;
              $payment_methods = PaymentMethod::where('branch_id',auth()->user()->branch_id)->get();

        return view('Counter.Model.expense',compact('expense','payment_methods'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'branch_id' => 'required',
            'expense_category' => 'required',
          //  'tot_bf_vat' => 'required',
          //  'vat_amt' => 'required',
            'amount' => 'required',
          'payment_type'=>'required',
        ],[
         //   'tot_bf_vat.*' => 'Total Before Vat required',
         //   'vat_amt.*' => 'Vat required',
            'amount.*' => 'Final Amount required',
            'expense_category.*' => 'Expense Category required',
        ]);

        if($validation->fails())
        {
            return $this->sendResponse(0,'',$validation->errors(),'');
        }

        if(!(checkUserPermission('expense')))
        {
            return $this->sendResponse(1,config('constant.UNAUTHORIZED_ACCESS'),'',url('home'));
        }

        $expense = Expense::create([
            'expense_cat_id' => $request->expense_category,
            'expense_cat_name' => expenseCatByID($request->expense_category)->expense_category_name,
            'invoice_no' => $request->invoice_no,
            'description' => $request->description,
            'payment_type' => $request->payment_type,
            'total_before_vat' => $request->tot_bf_vat,
            'vat' => $request->vat_amt,
            'total_amount' => $request->amount,
            'action' => 'Counter',//TODO:based on front or back
            'payment_status' => 'paid',//TODO:based on filter
            'user_id' => auth()->user()->id,
            'branch_id' => $request->branch_id,
            'uuid' => Str::uuid(),
        ]);

        event(new PaymentTransactionEvent(
            type: 'sub',
            amount: $request->amount,
            refNo: $expense->id,
            paymentType: $request->payment_type,
            status: 'expense',
            branchId: $request->branch_id,
        ));

        return $this->sendResponse(1,'Expense Created','','');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
