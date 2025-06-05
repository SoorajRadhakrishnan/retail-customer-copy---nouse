@extends('Admin.theme')
<?php

$from_date = isset($_GET['from_date']) && $_GET['from_date'] != '' ? $_GET['from_date'] : date('Y-m-d');
$to_date = isset($_GET['to_date']) && $_GET['to_date'] != '' ? $_GET['to_date'] : date('Y-m-d');
$session_branch = getSessionBranch() ? " - ".getBranchById(getSessionBranch()) : "";
$branch_name = auth()->user()->branch_id ? " - ".auth()->user()->branch->branch_name : $session_branch;
$title = 'DAY CLOSING REPORT'.$branch_name.' - '.$from_date." - ".$to_date;

?>
@section('title',$title)

@section('style')

@endsection

@section('content')

    <div class="az-content az-content-dashboard  animate__animated animate__fadeIn">
        <div class="container-fluid">
            <div class="az-content-body">
                <div class="col-12">
                    <div class="az-dashboard-one-title">
                        <div>
                            <h2 class="az-dashboard-title">Day Closing Report</h2>
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
                                        <a href="{{ url('admin/settle-excel') }}?from_date={{ $from_date }}&to_date={{ $to_date }}"
                                            class="dt-button buttons-excel buttons-html5 btn btn-dark px-3 rounded-10"
                                            tabindex="0" aria-controls="example" type="button"><span><i
                                                    class="fa fa-file-excel-o" style="font-size:1.2rem"></i></span>
                                        </a>
                                        <a href="{{ url('admin/settle-print') }}?from_date={{ $from_date }}&to_date={{ $to_date }}" class="dt-button buttons-print btn btn-dark px-3 rounded-10" tabindex="0"
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
                                                <th>Settle Date</th>
                                                <th>Cash At Starting</th>
                                                <th>Cash Sale</th>
                                                <th>Card Sale</th>
                                                <th>Credit Sale</th>
                                                <th>Credit Recover</th>
                                                <th>Delivery Sale</th>
                                                <th>Delivery Recover</th>
                                                <th>Payback</th>
                                                <th>Payback Vat</th>
                                                <th>Expense</th>
                                                <th>Purchase</th>
                                                <th>Gross Total</th>
                                                <th>Discount</th>
                                                <th>Sale VAT</th>
                                                <th>Net Total</th>
                                                <th>Cash Drawer</th>
                                                <th>Print</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($data) > 0)
                                                @foreach ($data as $key => $settle)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        @if (!auth()->user()->branch_id)
                                                            <td>{{ Str::ucfirst($settle->branch->branch_name) }}</td>
                                                        @endif
                                                        <td>{{ dateFormat($settle->settle_date,1) }}</td>
                                                        <td>{{ showAmount($settle->cash_at_starting) }}</td>
                                                        <td>{{ showAmount($settle->cash_sale) }}</td>
                                                        <td>{{ showAmount($settle->card_sale) }}</td>
                                                        <td>{{ showAmount($settle->credit_sale) }}</td>
                                                        <td>{{ showAmount($settle->credit_recover) }}</td>
                                                        <td>{{ showAmount($settle->delivery_sale) }}</td>
                                                        <td>{{ showAmount($settle->delivery_recover) }}</td>
                                                        <td>{{ showAmount($settle->pay_back) }}</td>
                                                        <td>{{ showAmount($settle->pay_back_vat) }}</td>
                                                        <td>{{ showAmount($settle->expense) }}</td>
                                                        <td>{{ showAmount($settle->purchase) }}</td>
                                                        <td>{{ showAmount($settle->gross_total) }}</td>
                                                        <td>{{ showAmount($settle->discount) }}</td>
                                                        <td>{{ showAmount($settle->gross_total_tax) }}</td>
                                                        <td>{{ showAmount($settle->net_total) }}</td>
                                                        <td>{{ showAmount($settle->cash_drawer) }}</td>
                                                        <td>
                                                            <?php
                                                            //$from_date = getSettleDateLastbf($settle->id);
                                                            $url = url('admin/settle-sale-reprint').'/'.$settle->id.'?shop='.$settle->shop_id;
                                                            // $url = url('admin/settle-sale-reprint').'?from_date='.$from_date.
                                                            //             '&to_date='.$settle->settle_date; ?>
                                                            <div class="btn-group rounded-10" role="group"
                                                                aria-label="Basic example" data-bs-toggle="tooltip"
                                                                data-bs-placement="top" title="Print">
                                                                <a class="btn btn-dark pt-2 px-3 rounded-10"
                                                                    href="javascript:void(0)"
                                                                    onclick="printit('{{ sha1(time()) }}','{{ $url }}');"><i
                                                                        class="fa fa-print"></i>
                                                                </a>
                                                            </div>
                                                        </td>
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
        $('#supplier').select2({
            theme: "bootstrap-5",
        });
    });

</script>

@endsection
