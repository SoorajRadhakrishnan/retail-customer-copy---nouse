@extends('Admin.theme')

<?php

$from_date = isset($_GET['from_date']) && $_GET['from_date'] != '' ? $_GET['from_date'] : date('Y-m-d');
$to_date = isset($_GET['to_date']) && $_GET['to_date'] != '' ? $_GET['to_date'] : date('Y-m-d');
$session_branch = getSessionBranch() ? " - ".getBranchById(getSessionBranch()) : "";
$branch_name = auth()->user()->branch_id ? " - ".auth()->user()->branch->branch_name : $session_branch;
$title = 'BILL WISE REPORT'.$branch_name.' - '.$from_date." - ".$to_date;

?>
@section('title',$title)

@section('style')

@endsection

@section('content')


    <?php

    $customer_id = isset($_GET['customer']) && $_GET['customer'] != '' ? $_GET['customer'] : '';
    $receipt_id = isset($_GET['receipt_id']) && $_GET['receipt_id'] != '' ? $_GET['receipt_id'] : '';

    ?>

    <div class="az-content az-content-dashboard  animate__animated animate__fadeIn">
        <div class="container-fluid">
            <div class="az-content-body">
                <div class="col-12">
                    <div class="az-dashboard-one-title">
                        <div>
                            <h2 class="az-dashboard-title">Bill Wise Report</h2>
                            <p class="az-dashboard-text"></p>
                        </div>
                        <div class="az-content-header-right">
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card rounded-10 shadow">
                        <div class="card-header">
                            <form>
                                <div class="row d-flex flex-wrap">
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
                                        <label class="mb-0 d-block small font-weight-bold">Receipt ID</label>
                                        <input type="text" value="{{ $receipt_id }}" name="receipt_id"
                                            class="form-control rounded-10">
                                    </div>
                                    <div class="w-auto ml-3">
                                        <label class="mb-0 d-block small font-weight-bold">Customer</label>
                                        <select class="form-control rounded-10 select2" id="customer_id" name="customer"
                                            onchange="this.form.submit()">
                                            <option value="">Select Customer</option>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}"
                                                    @if ($customer->id == $customer_id) selected="selected" @endif>
                                                    {{ $customer->customer_number . ' - ' . Str::ucfirst($customer->customer_name) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                   <div class="w-auto ml-3">
                                        <label class="mb-0 d-block">Users</label>
                                        <select class="form-control rounded-10 select2" id="user_id" name="user_id"
                                            onchange="this.form.submit()">
                                            <option value="">Select User</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}"
                                                    @if ($user->id == $user_id) selected="selected" @endif>
                                                    {{ $user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="w-auto ml-3">
                                        <label class="mb-0 d-block small font-weight-bold">&nbsp;</label>
                                        <button type="submit" class="btn btn-dark rounded-10 px-3">
                                            Submit
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="card rounded-10 shadow">
                                <div class="card-body overflow-auto">
                                    {{-- <div class="dt-buttons">
                                        <a href="{{ url('admin/bill-wiser-excel') }}?from_date={{ $from_date }}&to_date={{ $to_date }}&receipt_id={{ $receipt_id }}&customer={{ $customer_id }}"
                                            class="dt-button buttons-excel buttons-html5 btn btn-dark px-3 rounded-10"
                                            tabindex="0" aria-controls="example" type="button"><span><i
                                                    class="fa fa-file-excel-o" style="font-size:1.2rem"></i></span>
                                        </a>
                                        <a href="{{ url('admin/bill-wiser-print') }}?from_date={{ $from_date }}&to_date={{ $to_date }}&receipt_id={{ $receipt_id }}&customer={{ $customer_id }}" class="dt-button buttons-print btn btn-dark px-3 rounded-10" tabindex="0"
                                            aria-controls="example" type="button"><span><i class="fa fa-file-pdf-o"
                                                    style="font-size:1.2rem"></i></span>
                                        </a>
                                    </div> --}}
                                    <table id="example" class="table table-hover table-custom border-bottom-0" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                @if (!auth()->user()->branch_id)
                                                    <th>Branch</th>
                                                @endif
                                                <th>Receipt ID</th>
                                                <th>Date</th>
                                              <th>User</th>
                                              
                                                <th>Customer</th>
                                                @if (app('appSettings')['staff_pin']->value == 'yes')
                                                    <th>Staff</th>
                                                @endif
                                                <th>Payment Type</th>
                                                <th>Wthout VAT</th>
                                                <th>VAT Amount</th>
                                                <th>Gross Total</th>
                                                <th>Discount</th>
                                                <th>Net Total</th>
                                            </tr>
                                        </thead>
                                        <?php $total_amount = $total_without_discount = $total_discount = 0; ?>
                                        <tbody>
                                            @if (count($data) > 0)
                                                @foreach ($data as $key => $value)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        @if (!auth()->user()->branch_id)
                                                            <td>{{ getBranchById($value->shop_id) }}</td>
                                                        @endif
                                                        <td>{{ $value->receipt_id }}</td>
                                                        <td>{{ dateFormat($value->ordered_date, 1) }}</td>
                                                       @if ($value->user_id)
                                                            <td>{{ Str::ucfirst(getUser($value->user_id)->name) }}</td>
                                                        @else
                                                            <td></td>
                                                        @endif
                                                        <td>{{ $value->customer_id ? getCustomerDetById($value->customer_id) : '' }}</td>
                                                        @if (app('appSettings')['staff_pin']->value == 'yes')
                                                            @if ($value->staff_id)
                                                                <td>{{ getStaff($value->staff_id)->staff_name }}</td>
                                                            @else
                                                                <td></td>
                                                            @endif
                                                        @endif
                                                        <td>{{ Str::ucfirst($value->payment_type) }}</td>
                                                        <td>{{ showAmount($value->without_tax) }}</td>
                                                        <td>{{ showAmount($value->vat) }}</td>
                                                        <td>{{ showAmount($value->with_tax + $value->discount) }}</td>
                                                        <td>{{ showAmount($value->discount) }}</td>
                                                        <td>{{ showAmount($value->with_tax) }}</td>
                                                        <?php
                                                        $total_amount += $value->with_tax;
                                                        $total_discount += $value->discount;
                                                        $total_without_discount += $value->with_tax + $value->discount;
                                                        ?>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td>Total</td>
                                                @if (!auth()->user()->branch_id)
                                                    <td></td>
                                                @endif
                                                <td></td>
                                                <td></td>
                                                @if (app('appSettings')['staff_pin']->value == 'yes')
                                                    <td></td>
                                                @endif
                                                <td></td>
                                                <td></td>
                                                <td>{{ showAmount($total_without_discount, 1) }}</td>
                                                <td>{{ showAmount($total_discount, 1) }}</td>
                                                <td>{{ showAmount($total_amount, 1) }}</td>
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
    <script>
        $(document).ready(function() {
            $('#customer_id').select2({
                theme: "bootstrap-5",
            });
        });
    </script>

@endsection
