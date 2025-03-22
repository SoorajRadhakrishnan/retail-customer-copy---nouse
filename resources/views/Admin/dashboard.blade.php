    @extends('Admin.theme')

@section('title', 'DASHBOARD')

@section('style')

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@endsection

@section('content')

    <?php

    $from_date = isset($_GET['from_date']) && $_GET['from_date'] != '' ? $_GET['from_date'] : date('Y-m-d');
    $to_date = isset($_GET['to_date']) && $_GET['to_date'] != '' ? $_GET['to_date'] : date('Y-m-d');

    ?>
    <div class="az-content az-content-dashboard">
        <div class="container-fluid">
            <div class="row mb-4">
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
                                    {{-- <div class="w-auto ml-3">
                                        <label class="mb-0 d-block small font-weight-bold">Branch</label>
                                        <select name="branch" id="changebranch" class="form-control rounded-10" required
                                            onchange="changeBranch('changebranch')">
                                            <option value="t4ebb5516-869f-45fb-80a7-f8ec2f20fc84">BRANCHONE</option>
                                        </select>
                                    </div> --}}
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
            </div>
            <?php $payment_array = [];
            $total_sale = $other_sale = 0; ?>
            @foreach ($payment_amount as $item)
                <?php
                $payment_array[$item->payment_type] = $item->total_price;
                $total_sale += $item->total_price;
                if ($item->payment_type != 'cash' && $item->payment_type != 'card' && $item->payment_type != 'credit') {
                    $other_sale += $item->total_price;
                }
                ?>
            @endforeach
            <?php $top_items_array = $top_items_payment_array = []; ?>
            @foreach ($top_items as $items)
                <?php
                $top_items_payment_array[] = $items->total_price;
                $top_items_array[] = getItemNameSize($items->price_size_id);
                ?>
            @endforeach
            <div class="row mb-0">
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-xl-3 col-lg-4 col-md-6 mb-4 animate__animated animate__fadeInUp">
                            <div class="card rounded-10 shadow">
                                <div class="card-body card-body-bg-icon">
                                    <img src="assets/img/aed.png" alt="">
                                    <h5>TOTAL SALE</h5>
                                    <h4 class="mb-0">{{ showAmount($total_sale, 1) }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 mb-4 animate__animated animate__fadeInUp">
                            <div class="card rounded-10 shadow">
                                <div class="card-body card-body-bg-icon">
                                    <img src="assets/img/aed.png" alt="">
                                    <h5>TOTAL CASH SALE</h5>
                                    <h4 class="mb-0">
                                        {{ isset($payment_array['cash']) ? showAmount($payment_array['cash'], 1) : showAmount('0', 1) }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 mb-4 animate__animated animate__fadeInUp">
                            <div class="card rounded-10 shadow">
                                <div class="card-body card-body-bg-icon">
                                    <img src="assets/img/aed.png" alt="">
                                    <h5>TOTAL CARD SALE</h5>
                                    <h4 class="mb-0">
                                        {{ isset($payment_array['card']) ? showAmount($payment_array['card'], 1) : showAmount('0', 1) }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 mb-4 animate__animated animate__fadeInUp">
                            <div class="card rounded-10 shadow">
                                <div class="card-body card-body-bg-icon">
                                    <img src="assets/img/aed.png" alt="">
                                    <h5>TOTAL CREDIT SALE</h5>
                                    <h4 class="mb-0">
                                        {{ isset($payment_array['credit']) ? showAmount($payment_array['credit'], 1) : showAmount('0', 1) }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 mb-4 animate__animated animate__fadeInUp">
                            <div class="card rounded-10 shadow">
                                <div class="card-body card-body-bg-icon">
                                    <img src="assets/img/aed.png" alt="">
                                    <h5>TOTAL OTHER SALE</h5>
                                    <h4 class="mb-0">
                                        {{ showAmount($other_sale, 1) }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 mb-4 animate__animated animate__fadeInUp">
                            <div class="card rounded-10 shadow">
                                <div class="card-body card-body-bg-icon">
                                    <img src="assets/img/aed.png" alt="">
                                    <h5>TOTAL EXPENSE</h5>
                                    <h4 class="mb-0">{{ showAmount($expense_amount->total_price, 1) }}</h4>
                                </div>
                            </div>
                        </div>
                        @if (auth()->user()->branch_id)
                            <div class="col-xl-3 col-lg-4 col-md-6 mb-4 animate__animated animate__fadeInUp">
                                <div class="card rounded-10 shadow">
                                    <div class="card-body card-body-bg-icon">
                                        <img src="assets/img/aed.png" alt="">
                                        <h5>TOTAL CASH DRAWER</h5>
                                        <h4 class="mb-0">{{ showAmount($cashDrawer, 1) }}</h4>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-3">
                    <div class="row mb-4">
                        <div class="col-12 col-md-6 col-lg-6 col-xl-12">
                            <div class="card rounded-10 shadow animate__animated animate__fadeInUp">
                                <div class="card-header">
                                    <h4 class="mb-0 text-center">TOP 5 ITEMS</h4>
                                </div>
                                <div class="card-body" id="myPieChartDiv">
                                    <canvas id="myPieChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="card rounded-10 shadow animate__animated animate__fadeInUp">
                                <div class="card-header">
                                    <h4 class="mb-0 text-center">MONTHLY SALES</h4>
                                </div>
                                <div class="card-body">
                                    <canvas id="myBarChart"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div class="card rounded-10 shadow animate__animated animate__fadeInUp">
                                <div class="card-header">
                                    <h4 class="mb-0 text-center">MONTHLY EXPENSE</h4>
                                </div>
                                <div class="card-body">
                                    <canvas id="myBarChart2"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-xl-6 mb-4">
                    <div class="card rounded-10 shadow animate__animated animate__fadeInUp">
                        <div class="card-header">
                            <h4 class="mb-0 text-center">DAY WISE SALES</h4>
                        </div>
                        <div class="card-body overflow-auto">
                            <canvas id="chLine"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card rounded-10 shadow animate__animated animate__fadeInUp">
                        <div class="card-header">
                            <h4 class="mb-0 text-center">RECENT 20 SALES</h4>
                        </div>
                        <div class="card-body overflow-auto">
                            <table id="examples" class="table table-custom mb-0 mt-3" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Customer</th>
                                        <th>Total</th>
                                        <th>Print</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($RecentSales) > 0)
                                        @foreach ($RecentSales as $item)
                                            <tr>
                                                <td>{{ $item->receipt_id }}</td>
                                                <td>{{ dateFormat($item->ordered_date,1) }}</td>
                                                @if ($item->customer_number != 0)
                                                    <td>{{ $item->customer_name ." (".$item->customer_number.")" }}</td>
                                                @else
                                                    <td></td>
                                                @endif
                                                <td>{{ showAmount($item->with_tax) }}</td>
                                                    <?php $url = url('admin/print_dashboard')."?id=".$item->id."&re=dashboard"?>
                                                <td class="  text-center">
                                                    <div class="btn-group rounded-10" role="group"
                                                        aria-label="Basic example"> <a
                                                            class="btn btn-dark pt-2 px-3 rounded-10"
                                                            href="javascript:void(0)"
                                                            onclick="printit('{{ sha1(time()) }}','{{ $url }}');"><i
                                                                class="fa fa-print"></i></a></div>
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

@endsection

@section('script')

    {{-- TOP 5 Items --}}

    @if (count($top_items) > 0)
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

    {{-- MONTH WISE SALE --}}
    <script>
        var data = {
            labels: @json($labels),
            datasets: [{
                label: 'LAST 5 MONTH SALES',
                data: @json($data),
                backgroundColor: [
                    'rgba(59, 72, 99, 0.7)',
                    'rgba(59, 72, 99, 0.7)',
                    'rgba(59, 72, 99, 0.7)',
                    'rgba(59, 72, 99, 0.7)',
                    'rgba(59, 72, 99, 0.7)',
                ],
                borderColor: [
                    'rgba(59, 72, 99, 0.7)',
                    'rgba(59, 72, 99, 0.7)',
                    'rgba(59, 72, 99, 0.7)',
                    'rgba(59, 72, 99, 0.7)',
                    'rgba(59, 72, 99, 0.7)',
                ],
                borderWidth: 1
            }]
        };

        var ctx = document.getElementById('myBarChart').getContext('2d');

        var myBarChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 500 // Increment each tick by 100
                        }
                    }
                }
                // You can add additional options here
            }
        });
    </script>

    {{-- MONTH WISE EXPENSE --}}
    <script>
        var data2 = {
            labels: @json($expense_labels),
            datasets: [{
                label: 'LAST 5 MONTH EXPENSE',
                data: @json($expense_data),
                backgroundColor: [
                    'rgba(59, 72, 99, 0.7)',
                    'rgba(59, 72, 99, 0.7)',
                    'rgba(59, 72, 99, 0.7)',
                    'rgba(59, 72, 99, 0.7)',
                    'rgba(59, 72, 99, 0.7)',
                    'rgba(59, 72, 99, 0.7)',
                ],
                borderColor: [
                    'rgba(59, 72, 99, 0.7)',
                    'rgba(59, 72, 99, 0.7)',
                    'rgba(59, 72, 99, 0.7)',
                    'rgba(59, 72, 99, 0.7)',
                    'rgba(59, 72, 99, 0.7)',
                    'rgba(59, 72, 99, 0.7)',
                ],
                borderWidth: 1
            }]
        };
        // Get the context of the canvas element
        var ctx = document.getElementById('myBarChart2').getContext('2d');

        // Create the bar chart
        var myBarChart = new Chart(ctx, {
            type: 'bar',
            data: data2,
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 100 // Increment each tick by 100
                        }
                    }
                }
                // You can add additional options here
            }
        });
    </script>


    <script type="text/javascript">
        var colors = ['#3b4863', '#28a745', '#EC5FE7', "#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360"];
        var chLine = document.getElementById("chLine");
        var chartData = {
            labels: @json($day_labels),
            datasets: [{
                label: 'LAST 24 DAYS',
                data: @json($day_data),
                borderColor: colors[0],
                borderWidth: 4,
                pointBackgroundColor: colors[0]
            }, ]
        };
        if (chLine) {
            new Chart(chLine, {
                type: 'line',
                data: chartData,
                options: {
                    // scales: {
                    //     yAxes: [{
                    //         ticks: {
                    //             beginAtZero: false
                    //         }
                    //     }]
                    // },
                    legend: {
                        display: true
                    }
                }
            });
        }
    </script>

    <script>
         $('#examples').dataTable({
            order: [],
        });
    </script>


@endsection
