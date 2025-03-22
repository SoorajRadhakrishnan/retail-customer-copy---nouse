@extends('Admin.theme')
<?php

$from_date = isset($_GET['from_date']) && $_GET['from_date'] != '' ? $_GET['from_date'] : date('Y-m-d');
$to_date = isset($_GET['to_date']) && $_GET['to_date'] != '' ? $_GET['to_date'] : date('Y-m-d');
$session_branch = getSessionBranch() ? " - ".getBranchById(getSessionBranch()) : "";
$branch_name = auth()->user()->branch_id ? " - ".auth()->user()->branch->branch_name : $session_branch;
$title = 'PERFOMACE REPORT'.$branch_name.' - '.$from_date." - ".$to_date;

?>
@section('title',$title)

@section('style')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@endsection

@section('content')


<?php

$item_id = (isset($_GET['item_id']) && $_GET['item_id'] != '') ? $_GET['item_id'] : '';

?>

    <div class="az-content az-content-dashboard  animate__animated animate__fadeIn">
        <div class="container-fluid">
            <div class="az-content-body">
                <div class="col-12">
                    <div class="az-dashboard-one-title">
                        <div>
                            <h2 class="az-dashboard-title">Perfomance - Top Selling Report</h2>
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
                                        <label class="mb-0 d-block small font-weight-bold">Item</label>
                                        <select class="form-control rounded-10 select2" id="item_id" name="item_id"
                                            onchange="this.form.submit()">
                                            <option value="">Select Item</option>
                                            @foreach ($items as $item)
                                                <option value="{{ $item->price_id }}"
                                                    @if ($item->price_id == $item_id) selected="selected" @endif>
                                                    {{ Str::ucfirst($item->item_name) . ($item->size_name === 'Unit price' ? '' : ' - ' . $item->size_name) }}

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
                <?php $top_items_array = $top_items_payment_array = []; ?>
                @foreach ($data as $key => $items)
                    <?php
                    $top_items_payment_array[] = $items->after_discount;
                    $top_items_array[] = getItemNameSize($items->price_size_id);
                    $top_items_color_array[] = 'rgba(59, 72, 99, 0.'.$key.')';
                    ?>
                @endforeach
                <div class="row">
                    <div class="col-4">
                    </div>
                    <div class="col-3 mt-4">
                        <div class="row mb-4">
                            <div class="col-12 col-md-6 col-lg-6 col-xl-12">
                                <div class="card rounded-10 shadow animate__animated animate__fadeInUp">
                                    <div class="card-header">
                                        <h4 class="mb-0 text-center">ITEMS</h4>
                                    </div>
                                    <div class="card-body" id="myPieChartDiv" style="height: 340px !important">
                                        <canvas id="myPieChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                    </div>
                </div>
                <div class="col-12 mt-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="card rounded-10 shadow">
                                <div class="card-body overflow-auto">
                                    {{-- <div class="dt-buttons">
                                        <a href="{{ url('admin/perfomance-excel') }}?from_date={{ $from_date }}&to_date={{ $to_date }}&item_id={{ $item_id }}"
                                            class="dt-button buttons-excel buttons-html5 btn btn-dark px-3 rounded-10"
                                            tabindex="0" aria-controls="example" type="button"><span><i
                                                    class="fa fa-file-excel-o" style="font-size:1.2rem"></i></span>
                                        </a>
                                        <a href="{{ url('admin/perfomance-print') }}?from_date={{ $from_date }}&to_date={{ $to_date }}&item_id={{ $item_id }}" class="dt-button buttons-print btn btn-dark px-3 rounded-10" tabindex="0"
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
                                                <th>Item</th>
                                                <th>Qty</th>
                                                <th>Gross Total</th>
                                                <th>Discount</th>
                                                <th>Net Total</th>
                                            </tr>
                                        </thead>
                                        <?php $total_amount = $total_without_discount = $total_discount = 0;?>
                                        <tbody>
                                            @if (count($data) > 0)
                                                @foreach ($data as $key => $value)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        @if (!auth()->user()->branch_id)
                                                            <td>{{ getBranchById($value->shop_id) }}</td>
                                                        @endif
                                                        @if ($value->price_size_id)
                                                            <td>{{ Str::ucfirst(getItemNameSize($value->price_size_id)) }}</td>
                                                        @else
                                                            <td></td>
                                                        @endif
                                                        <td>{{ $value->total_qty }}</td>
                                                        <td>{{ showAmount($value->total_price) }}</td>
                                                        <td>{{ showAmount($value->total_price - $value->after_discount) }}</td>
                                                        <td>{{ showAmount($value->after_discount) }}</td>
                                                        <?php
                                                            $total_amount += $value->after_discount;
                                                            $total_discount += ($value->total_price - $value->after_discount);
                                                            $total_without_discount += $value->total_price;
                                                        ?>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td></td>
                                                @if (!auth()->user()->branch_id)
                                                    <td></td>
                                                @endif
                                                <td></td>
                                                <td></td>
                                                <td>{{ showAmount($total_without_discount,1) }}</td>
                                                <td>{{ showAmount($total_discount,1) }}</td>
                                                <td>{{ showAmount($total_amount,1) }}</td>
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

    @if (count($data) > 0)
        <script>
            var data = {
                labels: @json($top_items_array),
                datasets: [{
                    data: @json($top_items_payment_array),
                    backgroundColor: ['rgba(59, 72, 99, 0.9)', 'rgba(59, 72, 99, 0.8)', 'rgba(59, 72, 99, 0.7)',
                        'rgba(59, 72, 99, 0.6)', 'rgba(59, 72, 99, 0.5)'
                    ]
                }]
            };

            var ctx = document.getElementById('myPieChart').getContext('2d');
            var myPieChart = new Chart(ctx, {
                type: 'pie',
                data: data,
                options: {
                    // You can add additional options here
                }
            });
        </script>
    @else
        <script>
            $("#myPieChartDiv").html('<h4 class="py-5 my-5 text-center text-muted">NO SALES</h4>');
        </script>
    @endif

<script>
    $(document).ready(function() {
        $('#item_id').select2({
            theme: "bootstrap-5",
        });
    });
</script>

@endsection
