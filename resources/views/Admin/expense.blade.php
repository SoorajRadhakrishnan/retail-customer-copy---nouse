@extends('Admin.theme')

@section('title', 'EXPENSE')

@section('style')

@endsection

@section('content')

<?php

$from_date = isset($_GET['from_date']) && $_GET['from_date'] != '' ? $_GET['from_date'] : date('Y-m-d');
$to_date = isset($_GET['to_date']) && $_GET['to_date'] != '' ? $_GET['to_date'] : date('Y-m-d');

?>
    <div class="az-content az-content-dashboard  animate__animated animate__fadeIn">
        <div class="container-fluid">
            <div class="az-content-body">
                <div class="col-12">
                    <div class="az-dashboard-one-title">
                        <div>
                            <h2 class="az-dashboard-title">Expense</h2>
                            <p class="az-dashboard-text"></p>
                        </div>
                        <div class="az-content-header-right">
                        </div>
                    </div>
                    <div class="az-dashboard-nav border-0">
                        <nav class="nav">
                            @if (checkUserPermission('expense_create') && getbranchid())
                                <button id="createbtn"
                                    class="nav-linkk btn btn-dark rounded-10 shadoww mr-2 mb-2 dynamicPopup" data-pop="md"
                                    data-url="{{ url('admin/expense/create') }}" data-toggle="modal"
                                    data-target="#dynamicPopup-md"
                                    data-image="{{ url(config('constant.LOADING_GIF')) }}" ><i
                                        class="fa fa-plus-circle mr-1"></i> Create</button>
                            @endif
                        </nav>
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

                                        <div class="w-auto ml-3 ">
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
                                    <table id="example" class="table table-hover table-custom border-bottom-0" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%">S.No</th>
                                                @if (!auth()->user()->branch_id)
                                                    <th>Branch</th>
                                                @endif
                                                <th>Expense Category Name</th>
                                                <th>Invoice Number</th>
                                                <th>Description</th>
                                                <th>Payment Status</th>
                                                <th>Payment type</th>
                                                <th>Total Before VAT</th>
                                                <th>VAT Amount</th>
                                                <th>Final Amount</th>
                                                @if ((checkUserPermission('expense_edit') || checkUserPermission('expense_delete')) && getbranchid())
                                                    <th>Action</th>
                                                @endif
                                            </tr>
                                        </thead>
                                                                                <tbody>
                                            @php
                                                $paymentMethods = PaymentList(auth()->user()->branch_id);
                                            @endphp
                                            @if (count($expenses) > 0)
                                                @foreach ($expenses as $key => $expense)
                                                    <tr>
                                                        <td style="width: 5%">{{ $key + 1 }}</td>
                                                        @if (!auth()->user()->branch_id)
                                                            <td>{{ Str::ucfirst($expense->branch->branch_name) }}</td>
                                                        @endif
                                                        <td>{{ Str::ucfirst($expense->expense_cat_name) }}</td>
                                                        <td>{{ Str::ucfirst($expense->invoice_no) }}</td>
                                                        <td>{{ Str::ucfirst($expense->description) }}</td>
                                                        <td>{{ Str::ucfirst($expense->payment_status) }}</td>
                                                        <td>
                                                            @php
                                                                $method = $paymentMethods->firstWhere('id', $expense->payment_method_id ?? $expense->payment_type);
                                                                echo $method
                                                                    ? $method->payment_method_name
                                                                    : ($expense->payment_type
                                                                        ? $expense->payment_type
                                                                        : '-');
                                                            @endphp
                                                        </td>
                                                        <td>{{ showAmount($expense->total_before_vat) }}</td>
                                                        <td>{{ showAmount($expense->vat) }}</td>
                                                        <td>{{ showAmount($expense->total_amount) }}</td>
                                                        @if ((checkUserPermission('category_edit') || checkUserPermission('category_delete')) && getbranchid())
                                                            <td>
                                                                <div class="dropstart">
                                                                    <a class="dropdown-toggle text-dark" type="button"
                                                                        data-toggle="dropdown"
                                                                        aria-expanded="false">Actions</a>
                                                                    <ul class="dropdown-menu dropdown-menu-right rounded-10 border"
                                                                        x-placement="bottom-end" style="font-size: 16px;">
                                                                        @if (checkUserPermission('expense_edit'))
                                                                            <li>
                                                                                <a class="dropdown-item rounded-0 border-bottom dynamicPopup"
                                                                                    data-pop="md"
                                                                                    data-url="{{ url('admin/expense/') . '/' . $expense->uuid . '/edit' }}"
                                                                                    data-toggle="modal"
                                                                                    data-target="#dynamicPopup-md"

                                                                                    data-image="{{ url(config('constant.LOADING_GIF')) }}"
                                                                                    >Edit</a>
                                                                            </li>
                                                                        @endif
                                                                        @if (checkUserPermission('expense_delete'))
                                                                            <li>
                                                                                <a class="dropdown-item rounded-0 border-0"
                                                                                    href="javascript:void(0)"
                                                                                    onclick="deletemodel('{{ $expense->uuid }}','{{ $expense->invoice_no }}','Delete Expense','{{ url('admin/expense') . '/' . $expense->uuid }}')">Delete</a>
                                                                            </li>
                                                                        @endif
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>

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
