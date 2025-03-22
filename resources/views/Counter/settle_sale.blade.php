@extends('Counter.Layout.theme')

@section('title', 'SETTLE SALE')

@section('style')

@endsection

@section('content')

    {{ $branch_id = auth()->user()->branch_id }}
    <div class="az-content az-content-dashboard  animate__animated animate__fadeIn">
        <div class="container-fluid">
            <div class="az-content-body">
                <div class="col-12">
                    <div class="az-dashboard-one-title">
                        <div>
                            <h2 class="az-dashboard-title">Day Closing</h2>
                            @if (getLastsettledate($branch_id))
                                <p class="az-dashboard-text">Last Closing date -
                                    {{ dateFormat(getLastsettledate($branch_id)->settle_date, 1) }}</p>
                            @endif
                        </div>
                        <div class="az-content-header-right">
                        </div>
                    </div>
                    <!-- <div class="az-dashboard-nav border-0">
                                        <nav class="nav">
                                            <button class="nav-linkk btn btn-dark rounded-10 shadoww mr-2 mb-2" onclick="window.location.reload()" title="click to reload this page"><i class="fa fa-refresh mr-0"></i></button>
                                            <a class="nav-link rounded-10 mr-2 d-none" href="#"><i class="fas fa-ellipsis-h"></i></a>
                                        </nav>
                                    </div> -->
                    {{-- <div class="collapse show" id="collapseExample">
        <div class="card card-body rounded-10 shadow">
            <form action="">
                <input type="hidden" name="type" id="type" value="day-close">
                <div class="d-flex flex-wrap">
                    <div class="form-group mt-0 mb-0 w-search">
                        <label class="mb-0">From Date</label>
                        <input type="date" class="form-control rounded-10" id="from" placeholder="" name="from" required="" value="2024-07-28" onchange="this.form.submit()">
                    </div>
                    <div class="form-group mt-0 mb-0 w-search">
                        <label class="mb-0">To Date</label>
                        <input type="date" class="form-control rounded-10" id="to" placeholder="" name="to" required="" value="2024-07-28" onchange="this.form.submit()">
                    </div>
                </div>
            </form>
        </div>
    </div> --}}
                </div>
                <div class="col-12 mt-4">
                    <div class="row d-flex justify-content-center">
                        <div class="col-xl-6 col-lg-8 col-md-10">
                            <div class="card rounded-10 shadow">
                                <div class="card-body overflow-auto">
                                    <div id="example_wrapper" class="dataTables_wrapper no-footer">
                                        <table class="table table-custom" style="width:100%; font-weight:bold">
                                            <tbody>
                                                <tr class="odd">
                                                    <td>GROSS TOTAL</td>
                                                    <td>{{ showAmount($settle_sales['gross_total'], 1) }}</td>
                                                </tr>
                                                <tr class="even">
                                                    <td>DISCOUNT</td>
                                                    <td>{{ showAmount($settle_sales['discount'], 1) }}</td>
                                                </tr>
                                                {{-- <tr class="odd">
                                                    <td>TOTAL BEFORE VAT</td>
                                                    <td>{{ showAmount(0,1) }}</td>
                                                </tr>
                                                <tr class="even">
                                                    <td>VAT</td>
                                                    <td>{{ showAmount(0,1) }}</td>
                                                </tr> --}}
                                                <tr class="odd">
                                                    <td>NET TOTAL</td>
                                                    <td>{{ showAmount($settle_sales['net_total'], 1) }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt-4">
                    <div class="row d-flex justify-content-center">
                        <div class="col-xl-6 col-lg-8 col-md-10">
                            <div class="card rounded-10 shadow">
                                <div class="card-body overflow-auto">
                                    <div id="example_wrapper" class="dataTables_wrapper no-footer">
                                        <table class="table table-custom" style="width:100%; font-weight:bold">
                                            <tbody>
                                                <tr class="odd">
                                                    <td class="text-bold">CASH AT STARTING</td>
                                                    <td>{{ showAmount($settle_sales['cash_at_starting'], 1) }}</td>
                                                </tr>
                                                <?php
                                                    $payment_types_amount = $settle_sales['multi_payment_types_amount'];
                                                    $cash_not_amount=0;
                                                    if(count($payment_types_amount)!=0){foreach ($payment_types_amount as $pay_value) { ?>
                                                <tr>
                                                    <td>TOTAL {{ Str::upper($pay_value['payment_type']) }} SALE
                                                    </td>
                                                    <td><?php
                                                    echo showAmount($pay_value['amount'], 1);
                                                    ?></td>
                                                </tr>
                                                <?php }} ?>
                                                <tr class="odd">
                                                    <td>CREDIT RECOVERY</td>
                                                    <td>{{ showAmount($settle_sales['credit_recover'], 1) }}</td>
                                                </tr>
                                                @if (app('appSettings')['delivery_sale']->value == 'yes')
                                                    <tr class="even">
                                                        <td>DELIVERY SALE</td>
                                                        <td>{{ showAmount($settle_sales['delivery_sale'], 1) }}</td>
                                                    </tr>
                                                    <tr class="odd">
                                                        <td>DELIVERY RECOVERY</td>
                                                        <td>{{ showAmount($settle_sales['delivery_recover'], 1) }}</td>
                                                    </tr>
                                                @endif
                                                <tr class="even">
                                                    <td>PAYBACK</td>
                                                    <td>{{ showAmount($settle_sales['pay_back'], 1) }}</td>
                                                </tr>
                                                @if (getVat($branch_id)->vat != 'no_vat')
                                                    <tr class="even">
                                                        <td>PAYBACK VAT</td>
                                                        <td>{{ showAmount($settle_sales['pay_back_vat'], 1) }}</td>
                                                    </tr>
                                                @endif
                                                <tr class="odd">
                                                    <td>EXPENSE</td>
                                                    <td>{{ showAmount($settle_sales['expense'], 1) }}</td>
                                                </tr>
                                                @if (getVat($branch_id)->vat != 'no_vat')
                                                    <tr class="even">
                                                        <td>SALE VAT</td>
                                                        <td>{{ showAmount($settle_sales['gross_total_tax'], 1) }}</td>
                                                    </tr>
                                                @endif
                                                <tr class="odd">
                                                    <td>CASH DRAWER</td>
                                                    <td>{{ showAmount($settle_sales['cash_drawer'], 1) }}</td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                            <div class="card rounded-10 shadow mt-4">
                                <div class="card-body overflow-auto">

                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-dark px-3 rounded-10 print_btn" tabindex="0" aria-controls="example" type="button">
                                            <span style="font-size:1.2rem">Print</span>
                                        </button>
                                        <button class="btn btn-dark px-3 rounded-10 submit_btn ml-2" tabindex="0" aria-controls="example" type="button">
                                            <span style="font-size:1.2rem">Submit</span>
                                        </button>
                                    </div>

                                </div>
                            </div>
                                                            </div>
                            </div>
                        </div>
                        <iframe id="contentFrame"
                            src="{{ url('settle-sale/create') }}?from_date={{ Session::get('print_date') }}"
                            style="display:none"></iframe>
                    </div>
                </div>
            </div>
            <form action="{{ url('settle-sale') }}" method="post" id="settle-form">
                @csrf
            </form>


        @endsection

        @section('script')

            <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"
                integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>

            @if (Session::has('print_date'))
                <script>
                    const iframe = document.getElementById('contentFrame');
                    const iframeWindow = iframe.contentWindow;

                    // Open the print dialog for the iframe content
                    iframeWindow.focus(); // Ensure the iframe is in focus
                    iframeWindow.print();
                </script>
            @endif
            <script>
                $(".print_btn").on("click", function() {
                    const iframe = document.getElementById('contentFrame');
                    const iframeWindow = iframe.contentWindow;

                    // Open the print dialog for the iframe content
                    iframeWindow.focus(); // Ensure the iframe is in focus
                    iframeWindow.print();
                });

                $(".submit_btn").on("click", function() {
                    if (confirm('Are you sure you want to Settle?')) {
                        $("#settle-form").submit();
                    } else {
                        return false;
                    }
                });
            </script>

        @endsection
