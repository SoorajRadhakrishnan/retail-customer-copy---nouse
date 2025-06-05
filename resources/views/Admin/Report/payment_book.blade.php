@extends('Admin.theme')

@section('title', 'CASH/BANK LEDGER')

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
                            <h2 class="az-dashboard-title">Cash/Bank Ledger</h2>
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
                                            <input type="date"
                                                value="{{ $from_date }}"
                                                name="from_date" class="form-control rounded-10" onchange="this.form.submit()">
                                        </div>
                                        <div class="w-auto ml-3">
                                            <label class="mb-0 d-block small font-weight-bold">To Date</label>
                                            <input type="date" value="{{ $to_date }}" name="to_date"
                                                class="form-control rounded-10" required onchange="this.form.submit()">
                                        </div>
                                        <div class="w-auto ml-3">
                                            <label class="mb-0 d-block small font-weight-bold">Payment Type</label>
                                            <select class="form-control rounded-10" id="payment_type" name="payment_type" onchange="this.form.submit()">
                                                <option value="">Select Payment</option>
                                                <?php $PaymentLists = PaymentList(auth()->user()->branch_id); ?>
                                                @foreach ($PaymentLists as $PaymentList)
                                                    @if ($PaymentList->payment_method_name != 'credit')
                                                        <option value="{{ $PaymentList->payment_method_slug }}"
                                                            @if ($PaymentList->payment_method_name == $payment_type) selected="selected" @endif>
                                                            {{ Str::ucfirst($PaymentList->payment_method_name) }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="w-auto ml-3">
                                            <label class="mb-0 d-block small font-weight-bold">&nbsp;</label>
                                            <button type="submit" class="btn btn-dark rounded-10 px-3">
                                                Submit </button>
                                        </div>
                                        <div class="w-auto ml-3">
                                            <label class="mb-0 d-block small font-weight-bold">&nbsp;</label>
                                            <a href="{{ url('admin/payment-book') }}" class="btn btn-dark rounded-10 px-3">
                                                Reset </a>
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
                                   @php
                                        $totalAmount = 0;
                                        foreach ($data as $row) {
                                            if ($row->type == 'add') {
                                                $totalAmount += $row->amount;
                                            } else {
                                                $totalAmount -= $row->amount;
                                            }
                                        }
                                    @endphp

                                                                        <div class="mb-3 text-right">
                                        <h5>
                                            Total Account Balance:
                                            <span class="{{ $grandTotal >= 0 ? 'text-success' : 'text-danger' }}">
                                                {{ showAmount($grandTotal, 1) }}
                                            </span>
                                        </h5>
                                    </div>

                                    <table id="example" class="table table-hover table-custom border-bottom-0"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                @if (!auth()->user()->branch_id)
                                                    <th>Branch</th>
                                                @endif
                                                <th>Date</th>
                                                <th>Transcation Type</th>
                                                <th>Payment Type</th>
                                                <th>Credit/Debit</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $totalAmount = 0;
                                            @endphp
                                            @if (count($data) > 0)
                                                @foreach ($data as $key => $values)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        @if (!auth()->user()->branch_id)
                                                            <td>{{ Str::ucfirst($values->branch->branch_name) }}</td>
                                                        @endif
                                                        <td>{{ dateFormat($values->created_at, 1) }}</td>
                                                        <td>{{ Str::ucfirst(str_replace("_"," ",$values->status)) }}</td>
                                                        <td>{{ Str::ucfirst($values->payment_type) }}</td>
                                                        @if ($values->type == 'add')
                                                            <td>Credit</td>
                                                            <td style="color:green">{{ showAmount($values->amount) }}</td>
                                                            @php
                                                                $totalAmount += $values->amount;
                                                            @endphp
                                                        @else
                                                            <td>Debit</td>
                                                            <td style="color:red">{{ showAmount($values->amount) }}</td>
                                                            @php
                                                                $totalAmount -= $values->amount;
                                                            @endphp
                                                        @endif
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
                                                <td></td>
                                                <td></td>
                                                <td>{{ showAmount($totalAmount, 1) }}</td>
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
            $('#supplier').select2({
                theme: "bootstrap-5",
            });
        });
    </script>

@endsection
