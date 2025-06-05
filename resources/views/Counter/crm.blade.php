@extends('Counter.Layout.theme')

@section('title', 'CRM')

@section('style')

<style>
    .ClickCustomer:hover{
        cursor: pointer;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@endsection

@section('content')

    <div class="az-content az-content-dashboard  animate__animated animate__fadeIn">
        <div class="container-fluid">
            <div class="az-content-body">
                <div class="col-12">
                    <div class="az-dashboard-one-title">
                        <div>
                            <h2 class="az-dashboard-title">CRM</h2>
                            <p class="az-dashboard-text"></p>
                        </div>
                        <div class="az-content-header-right">
                            <nav class="nav">
                                <button id="createbtn" class="nav-linkk btn btn-dark rounded-10 shadoww mr-2 mb-2 dynamicPopup"
                                data-pop="md" data-url="{{ url('crm/create') }}"
                                data-toggle="modal" data-target="#dynamicPopup-md" data-image="{{ url(config('constant.LOADING_GIF')) }}"
                                ><i class="fa fa-plus-circle mr-1"></i> Create</button>
                            </nav>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card rounded-10 shadow">
                            <div class="card-header">
                                <form>
                                    <div class="row d-flex flex-wrap">
                                        <div class="w-auto ml-4">
                                            <label class="mb-0 d-block small font-weight-bold">Customer</label>
                                            <select class="form-control rounded-10 select2" id="customer_id" name="customer"
                                                onchange="this.form.submit()">
                                                <option value="">Select Customer</option>
                                                <?php $customers = getCustomerall(auth()->user()->branch_id); ?>
                                                @foreach ($customers as $cus)
                                                    <option value="{{ $cus->id }}"
                                                        @if ($cus->id == $customer_id) selected="selected" @endif>
                                                        {{ $cus->customer_number . ' - ' . Str::ucfirst($cus->customer_name) }}
                                                    </option>
                                                @endforeach
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

                @if (app('request')->input('customer') == '')
                    <div class="col-12 mt-4">
                        <div class="row">
                            <div class="col-12">
                                <h5>Total 10 Customers
                                </h5>
                                <div class="card rounded-10 shadow">
                                    <div class="card-body overflow-auto">
                                        <table class="table table-custom" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Customer</th>
                                                    <th>customer Purchased Amount</th>
                                                    <th>Customer Purchased count</th>
                                                    @if (checkUserPermission('loyality_points'))
                                                        <th>Customer Points</th>

                                                    @endif

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (count($top_customes) > 0)
                                                    @foreach ($top_customes as $key => $cus)
                                                        <tr onclick="ClickCustomer('{{ $cus->customer_id }}')"
                                                            class="ClickCustomer">
                                                            <td>{{ $key + 1 }}</td>
                                                            <td>{{ getCustomerDetById($cus->customer_id) }}</td>
                                                            <td>{{ showAmount($cus->with_tax) }}</td>
                                                            <td>{{ $cus->total_count }}</td>
                                                            @if (checkUserPermission('loyality_points'))
                                                                <td>{{$cus->points}}</td>
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

                @endif
                @if ($customer !== null)

                    <div class="col-12 mt-4">
                        <div class="row">
                            <div class="col-12">
                                <h5>Total Purchased Amount: {{ showAmount($total_amount) }} -
                                    Total Purchased count: {{ $total_count }} -
                                    <a class="btn btn-dark rounded-10" href="{{ url('home') }}?customer={{ $customer->id }}"
                                        title="Go to Sale">
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    </a>
                                </h5>
                                <div class="card rounded-10 shadow">
                                    <div class="card-body overflow-auto">
                                        <table class="table table-custom" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>customer Name</th>
                                                    <th>customer Email</th>
                                                    <th>customer Number</th>
                                                    <th>customer Address</th>
                                                    <th>customer Gender</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($customer !== null)
                                                    {{-- @foreach ($customer as $key => $value) --}}
                                                    <tr>
                                                        <td>{{ Str::ucfirst(optional($customer)->customer_name) }}</td>
                                                        <td>{{ optional($customer)->customer_email }}</td>
                                                        <td>{{ optional($customer)->customer_number }}</td>
                                                        <td>{{ Str::ucfirst(optional($customer)->customer_address) }}</td>
                                                        <td>{{ Str::ucfirst(optional($customer)->customer_gender) }}</td>
                                                    </tr>
                                                    {{-- @endforeach --}}
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mt-4">
                        <div class="row">
                            <div class="col-12">
                                <h5>Latest 5 orders</h5>
                                <div class="card rounded-10 shadow">
                                    <div class="card-body overflow-auto align-content-center d-flex">
                                        <table class="table table-hover table-custom border-bottom-0" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>Receipt No.</th>
                                                    <th>Order Type</th>
                                                    <th>Gross Total </th>
                                                    <th>Discount</th>
                                                    <th>Net Total</th>
                                                    <th>Print</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (count($customer_orders) > 0)
                                                    @foreach ($customer_orders as $key => $value)
                                                        <tr>
                                                            <td>{{ $key + 1 }}</td>
                                                            <td>{{ $value->receipt_id }}</td>
                                                            <td>{{ Str::ucfirst(str_replace("_"," ",$value->order_type)) }}</td>
                                                            <td>{{ showAmount($value->without_tax) }}</td>
                                                            <td>{{ showAmount($value->discount, 1) }}</td>
                                                            <td>{{ showAmount($value->with_tax, 1) }}</td>
                                                            <?php $url = url('print') . '?id=' . $value->id . '&re=crm'; ?>
                                                            <td>
                                                                <div class="btn-group rounded-10" role="group"
                                                                    aria-label="Basic example" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top" title="Items">
                                                                    <a href="javascript:void(0)"
                                                                        class="btn btn-dark pt-2 px-3 rounded-10 shadow dynamicPopup"
                                                                        title="Items" data-pop="lg"
                                                                        data-url="{{ url('recent-sale/create') }}?id={{ $value->id }}"
                                                                        data-toggle="modal" data-target="#dynamicPopup-lg"

                                                                        data-image="{{ url(config('constant.LOADING_GIF')) }}"
                                                                        >
                                                                        <i class="fa fa-list"></i>
                                                                    </a>
                                                                </div>
                                                                <div class="btn-group rounded-10" role="group"
                                                                    aria-label="Basic example" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top" title="Print">
                                                                    <a class="btn btn-dark pt-2 px-3 rounded-10"
                                                                        href="javascript:void(0)"
                                                                        onclick="printit('{{ sha1(time()) }}','{{ $url }}');"><i
                                                                            class="fa fa-print"></i>
                                                                    </a>
                                                                </div>
                                                                <div class="btn-group rounded-10" role="group"
                                                                    aria-label="Basic example" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top" title="Payback">
                                                                    <a class="btn btn-dark pt-2 px-3 rounded-10"
                                                                        href="{{ url('pay-back') }}?key={{ $value->receipt_id }}">
                                                                        <i class="fa fa-undo" aria-hidden="true"></i>
                                                                    </a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="4" align="center">No data</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <?php $top_items_array = $top_items_payment_array = []; ?>
                        @foreach ($item_orders as $items)
                            <?php
                            $top_items_payment_array[] = $items->total_price;
                            $top_items_array[] = getItemNameSize($items->price_size_id);
                            ?>
                        @endforeach
                        <div class="col-3 mt-4">
                                <div class="row mb-4">
                                    <div class="col-12 col-md-6 col-lg-6 col-xl-12">
                                        <div class="card rounded-10 shadow animate__animated animate__fadeInUp">
                                            <div class="card-header">
                                                <h4 class="mb-0 text-center">TOP 5 ITEMS</h4>
                                            </div>
                                            <div class="card-body" id="myPieChartDiv" style="height: 340px !important">
                                                <canvas id="myPieChart"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>

                        <div class="col-9 mt-4">
                            <div class="row">
                                <div class="col-12">
                                    <h5>Top 5 Favourite Items</h5>
                                    <div class="card rounded-10 shadow">
                                        <div class="card-body overflow-auto">
                                            <table class="table table-custom" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>S.No.</th>
                                                        <th>Item Name</th>
                                                        <th>Count</th>
                                                        <th>Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (count($item_orders) > 0)
                                                        @foreach ($item_orders as $keys => $item_order)
                                                            <tr>
                                                                <td>{{ $keys + 1 }}</td>
                                                                <td>{{ getItemNameSize($item_order->price_size_id) }}</td>
                                                                <td>{{ $item_order->qty }}</td>
                                                                <td>{{ showAmount($item_order->item_price) }}</td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td colspan="4" align="center">No data</td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if (checkUserPermission('loyality_points'))

                    <div class="row">
                        <div class="col-12 mt-4">
                            <div class="row">
                                <div class="col-12">
                                    <h5>Points redeem history </h5>
                                    <div class="card rounded-10 shadow">
                                        <div class="card-body overflow-auto">
                                            <table class="table table-custom" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>S.No.</th>
                                                        <th>date</th>
                                                        <th>Receipt id </th>
                                                        <th>Points redeemed</th>
                                                        <th>Discount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (count($redeemHistory) > 0)
                                                        @foreach ($redeemHistory as $key => $value)
                                                            <tr>
                                                                <td>{{ $key + 1 }}</td>
                                                                @if (!auth()->user()->branch_id)
                                                                    <td>{{ getBranchById($value->shop_id) }}</td>
                                                                @endif
                                                                <td>{{dateFormat($value->created_at)}}</td>
                                                                <td>{{ $value->receipt_id }}</td>

                                                                {{-- Show "Points Redeemed" value only if points_redeemed > 0 --}}
                                                                    <td>{{ $value->points_redeemed }}</td>



                                                                <td>{{ showAmount($value->discount) }}</td>
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


                    @endif
                @endif

            </div>
        </div>
    </div>
    <div id="if"></div>

@endsection

@section('script')

    <script>
        $('.example').dataTable({
            "language": {
                "emptyTable": "No Data found"
            }
        });

        $(document).ready(function() {
            $('#customer_id').select2({
                theme: "bootstrap-5",
            });
        });

        function ClickCustomer(id)
        {
            window.location.href = "{{ url('crm') }}?customer="+id;
        }
    </script>

    @if (count($item_orders) > 0)
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

@endsection
