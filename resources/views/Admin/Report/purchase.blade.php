@extends('Admin.theme')
<?php

$from_date = isset($_GET['from_date']) && $_GET['from_date'] != '' ? $_GET['from_date'] : date('Y-m-d');
$to_date = isset($_GET['to_date']) && $_GET['to_date'] != '' ? $_GET['to_date'] : date('Y-m-d');
$session_branch = getSessionBranch() ? " - ".getBranchById(getSessionBranch()) : "";
$branch_name = auth()->user()->branch_id ? " - ".auth()->user()->branch->branch_name : $session_branch;
$title = 'PURCHASE'.$branch_name.' - '.$from_date." - ".$to_date;

?>
@section('title',$title)

@section('style')

@endsection

@section('content')

    <?php
    $supplier_id = isset($_GET['supplier_id']) && $_GET['supplier_id'] != '' ? $_GET['supplier_id'] : '';

    ?>
    <div class="az-content az-content-dashboard  animate__animated animate__fadeIn">
        <div class="container-fluid">
            <div class="az-content-body">
                <div class="col-12">
                    <div class="az-dashboard-one-title">
                        <div>
                            <h2 class="az-dashboard-title">Purchase</h2>
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
                                            <label class="mb-0 d-block small font-weight-bold">Supplier</label>
                                            <select class="form-control rounded-10 select2" id="supplier_id" name="supplier_id"
                                                onchange="this.form.submit()">
                                                <option value="">Select Supplier</option>
                                                @foreach ($suppliers as $suplier)
                                                    <option value="{{ $suplier->id }}"
                                                        @if ($suplier->id == $supplier_id) selected="selected" @endif>
                                                        {{ $suplier->supplier_name . ' - ' . Str::ucfirst($suplier->supplier_company_name) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="mb-0 d-block small font-weight-bold">Payment Status</label>
                                            <select class="form-control rounded-10 select2" id="payment_status" name="payment_status"
                                                onchange="this.form.submit()">
                                                <option value="">Select Payment Status</option>
                                                <option value="paid"
                                                    @if ($payment_status == 'paid') selected @endif>Paid</option>
                                                <option value="un_paid"
                                                    @if ($payment_status == 'un_paid') selected @endif>Un Paid</option>
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
                                        <a href="{{ url('admin/purchase-excel') }}?from_date={{ $from_date }}&to_date={{ $to_date }}&supplier_id={{ $supplier_id }}&payment_status={{ $payment_status }}"
                                            class="dt-button buttons-excel buttons-html5 btn btn-dark px-3 rounded-10"
                                            tabindex="0" aria-controls="example" type="button"><span><i
                                                    class="fa fa-file-excel-o" style="font-size:1.2rem"></i></span>
                                        </a>
                                        <a href="{{ url('admin/purchase-print') }}?from_date={{ $from_date }}&to_date={{ $to_date }}&supplier_id={{ $supplier_id }}&payment_status={{ $payment_status }}" class="dt-button buttons-print btn btn-dark px-3 rounded-10" tabindex="0"
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
                                                <th>Supplier</th>
                                                <th>Invoice Number</th>
                                                <th>Status</th>
                                                <th>Payment Status</th>
                                                <th>VAT Amount</th>
                                                <th>Final Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($data) > 0)
                                                @foreach ($data as $key => $purchase)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        @if (!auth()->user()->branch_id)
                                                            <td>{{ Str::ucfirst($purchase->branch->branch_name) }}</td>
                                                        @endif
                                                        <td>{{ Str::ucfirst($purchase->supplier_name) }}</td>
                                                        <td>{{ Str::ucfirst($purchase->invoice_no) }}</td>
                                                        <td>{{ Str::ucfirst($purchase->status) }}</td>
                                                        <td>{{ Str::ucfirst($purchase->payment_status) }}</td>
                                                        <td>{{ showAmount($purchase->tax_amount) }}</td>
                                                        <td>{{ showAmount($purchase->total_amount) }}</td>
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

<script>

    $(document).ready(function() {
        $('#supplier_id, #payment_status').select2({
            theme: "bootstrap-5",
        });
    });
</script>

@endsection
