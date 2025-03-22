@extends('Admin.theme')

<?php
$from_date = isset($_GET['from_date']) && $_GET['from_date'] != '' ? $_GET['from_date'] : date('Y-m-d');
$to_date = isset($_GET['to_date']) && $_GET['to_date'] != '' ? $_GET['to_date'] : date('Y-m-d');
$session_branch = getSessionBranch() ? ' - ' . getBranchById(getSessionBranch()) : '';
$branch_name = auth()->user()->branch_id ? ' - ' . auth()->user()->branch->branch_name : $session_branch;
$title = 'PURCHASE-PAY-LOG' . $branch_name . ' - ' . $from_date . ' - ' . $to_date;
?>
@section('title', $title)

@section('style')
@endsection

@section('content')

    <?php
    $supplier_id = isset($_GET['supplier_id']) && $_GET['supplier_id'] != '' ? $_GET['supplier_id'] : '';
    ?>

    <div class="az-content az-content-dashboard animate__animated animate__fadeIn">
        <div class="container-fluid">
            <div class="az-content-body">
                <div class="col-12">
                    <div class="az-dashboard-one-title">
                        <div>
                            <h2 class="az-dashboard-title">Purchase Pay Log</h2>
                            <p class="az-dashboard-text"></p>
                        </div>
                        <div class="az-content-header-right">
                        </div>
                    </div>
                        <div class="card rounded-10 shadow">
                            <div class="card-header">
                                <form>
                                    <div class="row">
                                        <div class="w-auto ml-3">
                                            <label class="mb-0 d-block small font-weight-bold">From Date</label>
                                            <input type="date"
                                                value="{{ request()->input('from_date') ? date('Y-m-d', strtotime($from_date)) : '' }}"
                                                name="from_date" class="form-control rounded-10" onchange="this.form.submit()">
                                        </div>

                                        <div class="w-auto ml-3">
                                            <label class="mb-0 d-block small font-weight-bold">To Date</label>
                                            <input type="date" value="{{ $to_date }}" name="to_date"
                                                class="form-control rounded-10" required onchange="this.form.submit()">
                                        </div>
                                        <div class="w-auto ml-3">
                                            <label class="mb-0 d-block small font-weight-bold">Supplier</label>
                                            <select class="form-control rounded-10 select2" id="supplier" name="supplier"
                                                onchange="this.form.submit()">
                                                <option value="">Select Supplier</option>
                                                @foreach ($suppliers as $suplier)
                                                    <option value="{{ $suplier->id }}"
                                                        @if ($suplier->id == $supplier) selected="selected" @endif>
                                                        {{ $suplier->supplier_name . ' - ' . Str::ucfirst($suplier->supplier_company_name) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>


                                        <div class="col-md-2">
                                            <label class="mb-0 d-block small font-weight-bold">Payment Status</label>
                                            <select class="form-control rounded-10 select2" id="payment_type"
                                                name="payment_type" onchange="this.form.submit()">
                                                <option value="">Select Payment Type</option>
                                                <option value="cash" @if ($payment_type == 'cash') selected @endif>
                                                    cash</option>
                                                <option value="card" @if ($payment_type == 'card') selected @endif>
                                                    card</option>
                                            </select>
                                        </div>
                                        <div class="w-auto ml-3">
                                            <label class="mb-0 d-block small font-weight-bold">&nbsp;</label>
                                            <button type="submit" class="btn btn-dark rounded-10 px-3">Submit</button>
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
                                    <table id="example" class="table table-hover table-custom border-bottom-0" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th style="width: 15%">S.No</th>
                                                @if (!auth()->user()->branch_id)
                                                    <th>Branch</th>
                                                @endif
                                                <th>Supplier</th>
                                                {{-- <th>Invoice Number</th> --}}
                                                {{-- <th>Payment Type</th> --}}
                                                <th>Debit (Paid Amount)</th>
                                                <th>Credit (Balance Amount)</th>
                                                <th>Statement</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($data) > 0)
                                                @foreach ($data as $key => $item)
                                                    <tr>
                                                        <td style="width: 15%">{{ $key + 1 }}</td>
                                                        @if (!auth()->user()->branch_id && isset($item->branch->branch_name))
                                                            <td>{{ Str::ucfirst($item->branch->branch_name) }}</td>
                                                        @endif
                                                        <td>{{ Str::ucfirst($item->supplier_name) }}</td>
                                                        {{-- <td>{{ $item->invoice_no }}</td> --}}
                                                        {{-- <td>{{ $item->payment_type }}</td>/ --}}
                                                        <td>{{ $item->total_paid ?? 'Not Yet Paid' }}</td> <!-- Paid Amount as Debit -->
                                                        <td>{{ $item->credit ?? 'Not Yet Paid' }}</td> <!-- Balance Amount as Credit -->                                                        <td><button id="createbtn"
                                                            class="dt-button buttons-excel buttons-html5 btn btn-dark px-3 rounded-10 dynamicPopup" data-pop="xl"
                                                            data-url="{{ url('admin/purchase-pay-log/create') }}?id={{ $item->supplier_name }}"
                                                            data-toggle="modal"
                                                            data-target="#dynamicPopup-xl"
                                                            data-image="{{ url(config('constant.LOADING_GIF')) }}"
                                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Statement"
                                                            style="border-radius:10px;">
                                                            <i class="fa fa-list" aria-hidden="true" style="font-size:1.2rem">
                                                            </i></button></td>
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
            $('#supplier, #payment_type').select2({
                theme: "bootstrap-5",
            });
        });
    </script>

@endsection
