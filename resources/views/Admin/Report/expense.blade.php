@extends('Admin.theme')
<?php

$from_date = isset($_GET['from_date']) && $_GET['from_date'] != '' ? $_GET['from_date'] : date('Y-m-d');
$to_date = isset($_GET['to_date']) && $_GET['to_date'] != '' ? $_GET['to_date'] : date('Y-m-d');
$session_branch = getSessionBranch() ? " - ".getBranchById(getSessionBranch()) : "";
$branch_name = auth()->user()->branch_id ? " - ".auth()->user()->branch->branch_name : $session_branch;
$title = 'EXPENSE REPORT'.$branch_name.' - '.$from_date." - ".$to_date;

?>
@section('title',$title)

@section('style')

@endsection

@section('content')

<?php

$payment_status = isset($_GET['payment_status']) && $_GET['payment_status'] != '' ? $_GET['payment_status'] : '';
$expense_cat_id = isset($_GET['expense_cat_id']) && $_GET['expense_cat_id'] != '' ? $_GET['expense_cat_id'] : '';

?>
    <div class="az-content az-content-dashboard  animate__animated animate__fadeIn">
        <div class="container-fluid">
            <div class="az-content-body">
                <div class="col-12">
                    <div class="az-dashboard-one-title">
                        <div>
                            <h2 class="az-dashboard-title">Expense Report</h2>
                            <p class="az-dashboard-text"></p>
                        </div>
                        <div class="az-content-header-right">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card rounded-10 shadow">
                            <div class="card-header">
                                <form>
                                    <div class="row">
                                        <div class="w-auto ml-3">
                                            <label class="mb-0 d-block small font-weight-bold">From Date</label>
                                            <input type="date" value="{{ $from_date }}" name="from_date"
                                                class="form-control rounded-10" required onchange="this.form.submit()">
                                        </div>
                                        <div class="w-auto ml-3">
                                            <label class="mb-0 d-block small font-weight-bold">To Date</label>
                                            <input type="date" value="{{ $to_date }}" name="to_date"
                                                class="form-control rounded-10" required onchange="this.form.submit()">
                                        </div>
                                        <div class="w-auto ml-3">
                                            <label class="mb-0 d-block small font-weight-bold">Expense Category</label>
                                            <select class="form-control rounded-10 select2" id="expense_cat_id" name="expense_cat_id"
                                                onchange="this.form.submit()">
                                                <option value="">Select Expense Category</option>
                                                @foreach ($expenseCats as $expenseCat)
                                                    <option value="{{ $expenseCat->id }}"
                                                        @if ($expenseCat->id == $expense_cat_id) selected="selected" @endif>
                                                        {{ Str::ucfirst($expenseCat->expense_category_name) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="w-auto ml-3">
                                            <label class="mb-0 d-block small font-weight-bold">Payment Status</label>
                                            <select class="form-control rounded-10 select2" id="payment_status" name="payment_status"
                                                onchange="this.form.submit()">
                                                <option value="">Select Payment Status</option>
                                                    <option value="paid"
                                                        @if ("paid" == $payment_status) selected="selected" @endif>
                                                        Paid
                                                    </option>
                                                    <option value="un_paid"
                                                        @if ("un_paid" == $payment_status) selected="selected" @endif>
                                                        Un Paid
                                                    </option>
                                            </select>
                                        </div>

                                        <div class="w-auto ml-3">
                                            <label class="mb-0 d-block small font-weight-bold">&nbsp;</label>
                                            <button type="submit" class="btn btn-dark rounded-10 px-3">
Submit                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="card rounded-10 shadow">
                                <div class="card-body overflow-auto">
                                    {{-- <div class="dt-buttons">
                                        <a href="{{ url('admin/expense-excel') }}?from_date={{ $from_date }}&to_date={{ $to_date }}&payment_status={{ $payment_status }}"
                                            class="dt-button buttons-excel buttons-html5 btn btn-dark px-3 rounded-10"
                                            tabindex="0" aria-controls="example" type="button"><span><i
                                                    class="fa fa-file-excel-o" style="font-size:1.2rem"></i></span>
                                        </a>
                                        <a href="{{ url('admin/expense-print') }}?from_date={{ $from_date }}&to_date={{ $to_date }}&payment_status={{ $payment_status }}" class="dt-button buttons-print btn btn-dark px-3 rounded-10" tabindex="0"
                                            aria-controls="example" type="button"><span><i class="fa fa-file-pdf-o"
                                                    style="font-size:1.2rem"></i></span>
                                        </a>
                                    </div> --}}
                                    <table id="example" class="table table-hover table-custom border-bottom-0" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%">S.No</th>
                                                @if (!auth()->user()->branch_id)
                                                    <th>Branch</th>
                                                @endif
                                                <th>Expense Category Name</th>
                                                <th>Added From</th>
                                                <th>Invoice Number</th>
                                                <th>Description</th>
                                                <th>Payment Status</th>
                                                <th>Total Before VAT</th>
                                                <th>VAT Amount</th>
                                                <th>Final Amount</th>
                                            </tr>
                                        </thead>
                                        <?php $tot_bf_vat = $tot_vat = $tot_amount = 0;?>
                                        <tbody>
                                            @if (count($data) > 0)
                                                @foreach ($data as $key => $expense)
                                                    <tr>
                                                        <td style="width: 5%">{{ $key + 1 }}</td>
                                                        @if (!auth()->user()->branch_id)
                                                            <td>{{ Str::ucfirst($expense->branch->branch_name) }}</td>
                                                        @endif
                                                        <td>{{ Str::ucfirst($expense->expense_cat_name) }}</td>
                                                        <td>{{ Str::ucfirst($expense->action) }}</td>
                                                        <td>{{ Str::ucfirst($expense->invoice_no) }}</td>
                                                        <td>{{ Str::ucfirst($expense->description) }}</td>
                                                        <td>{{ Str::ucfirst($expense->payment_status) }}</td>
                                                        <td>{{ showAmount($expense->total_before_vat) }}</td>
                                                        <td>{{ showAmount($expense->vat) }}</td>
                                                        <td>{{ showAmount($expense->total_amount) }}</td>
                                                    </tr>
                                                    <?php
                                                        $tot_bf_vat += $expense->total_before_vat;
                                                        $tot_vat += $expense->vat;
                                                        $tot_amount += $expense->total_amount;
                                                    ?>
                                                @endforeach
                                            @endif
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td style="width: 5%"></td>
                                                @if (!auth()->user()->branch_id)
                                                    <td></td>
                                                @endif
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>{{ showAmount($tot_bf_vat) }}</td>
                                                <td>{{ showAmount($tot_vat) }}</td>
                                                <td>{{ showAmount($tot_amount) }}</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')

@endsection
