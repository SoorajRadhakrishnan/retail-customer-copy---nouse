@extends('Admin.theme')
<?php

$from_date = isset($_GET['from_date']) && $_GET['from_date'] != '' ? $_GET['from_date'] : date('Y-m-d');
$to_date = isset($_GET['to_date']) && $_GET['to_date'] != '' ? $_GET['to_date'] : date('Y-m-d');
$session_branch = getSessionBranch() ? " - ".getBranchById(getSessionBranch()) : "";
$branch_name = auth()->user()->branch_id ? " - ".auth()->user()->branch->branch_name : $session_branch;
$title = 'OFFER WISE REPORT'.$branch_name.' - '.$from_date." - ".$to_date;

?>
@section('title',$title)

@section('style')

@endsection

@section('content')


<?php

$offer_id = (isset($_GET['offer_id']) && $_GET['offer_id'] != '') ? $_GET['offer_id'] : '';
// print_r($offer_id);
// exit;
?>


    <div class="az-content az-content-dashboard  animate__animated animate__fadeIn">
        <div class="container-fluid">
            <div class="az-content-body">
                <div class="col-12">
                    <div class="az-dashboard-one-title">
                        <div>
                            <h2 class="az-dashboard-title">Offer Wise Report</h2>
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
                                        <label class="mb-0 d-block ">From Date</label>
                                        <input type="date" value="{{ $from_date }}" name="from_date"
                                            class="form-control rounded-10" required onchange="this.form.submit()">
                                    </div>
                                    <div class="w-auto ml-3">
                                        <label class="mb-0 d-block ">To Date</label>
                                        <input type="date" value="{{ $to_date }}" name="to_date"
                                            class="form-control rounded-10" required onchange="this.form.submit()">
                                    </div>
                                    <div class="w-auto ml-3">
                                        <label class="mb-0 d-block">Offer</label>
                                        <select name="offer_id" class="form-control rounded-10 select2" required
                                            onchange="this.form.submit()">
                                            <option value="">Select Offer</option>
                                            @foreach ($offers as $offer)
                                                <option value="{{ $offer->id }}" {{ $offer_id == $offer->id ? 'selected' : '' }}>
                                                    {{ $offer->offer_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="w-auto ml-3">
                                        <label class="mb-0 d-block ">&nbsp;</label>
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
                                        <a href="{{ url('admin/order-type-excel') }}?from_date={{ $from_date }}&to_date={{ $to_date }}&offer_id={{ $offer_id }}"
                                            class="dt-button buttons-excel buttons-html5 btn btn-dark px-3 rounded-10"
                                            tabindex="0" aria-controls="example" type="button"><span><i
                                                    class="fa fa-file-excel-o" style="font-size:1.2rem"></i></span>
                                        </a>
                                        <a href="{{ url('admin/order-type-print') }}?from_date={{ $from_date }}&to_date={{ $to_date }}&offer_id={{ $offer_id }}" class="dt-button buttons-print btn btn-dark px-3 rounded-10" tabindex="0"
                                            aria-controls="example" type="button"><span><i class="fa fa-file-pdf-o"
                                                    style="font-size:1.2rem"></i></span>
                                        </a>
                                    </div> --}}
                                    <table id="example" class="table table-hover table-custom border-bottom-0" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th style="width: 15%">S.No</th>
                                                @if (!auth()->user()->branch_id)
                                                    <th>Branch</th>
                                                @endif
                                                <th>Reciept Id</th>
                                                <th>Offer Name</th>
                                                <th>Gross Total</th>
                                                <th>Discount</th>
                                                <th>Net Total</th>
                                            </tr>
                                        </thead>
                                        <?php $total_amount = $total_without_discount = $total_discount = 0;?>
                                        <tbody>
                                            @if (count($saleOrders) > 0)
                                                @foreach ($saleOrders as $key => $value)
                                                    <tr>
                                                        <td style="width: 15%">{{ $key + 1 }}</td>
                                                        @if (!auth()->user()->branch_id)
                                                            <td>{{ getBranchById($value->shop_id) }}</td>
                                                        @endif
                                                            <td>{{ Str::ucfirst(str_replace('_',' ',$value->receipt_id)) }}</td>
                                                        <td>{{ $value->offer_name }}</td>
                                                        <td>{{ showAmount($value->without_tax) }}</td>
                                                        <td>{{ showAmount($value->discount) }}</td>
                                                        <td>{{ showAmount($value->with_tax) }}</td>
                                          <?php
                                                            $total_amount += $value->with_tax;
                                                            $total_discount += ($value->discount);
                                                            $total_without_discount += $value->without_tax;
                                                        ?>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td style="width: 15%"></td>
                                                @if (!auth()->user()->branch_id)
                                                    <td></td>
                                                @endif
                                                <td></td>
                                                <td></td>
                                                <td class="font-weight-bold">{{ showAmount($total_without_discount,1) }}</td>
                                                <td class="font-weight-bold">{{ showAmount($total_discount,1) }}</td>
                                                <td class="font-weight-bold">{{ showAmount($total_amount,1) }}</td>
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
        $('.select2').select2({ theme: "bootstrap-5" });
    });
</script>

@endsection
