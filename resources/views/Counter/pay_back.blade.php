@extends('Counter.Layout.theme')

@section('title', 'PAY BACK')

@section('style')

@endsection

@section('content')

    <?php

    $PaymentLists = PaymentList(auth()->user()->branch_id);
    ?>

    <div class="az-content az-content-dashboard  animate__animated animate__fadeIn">
        <div class="container-fluid">
            <div class="az-content-body">
                        <div class="az-dashboard-one-title">
                        <div>
                            <h2 class="az-dashboard-title">Pay Back</h2>
                            <p class="az-dashboard-text"></p>
                        </div>
                    </div>
                    <div class="card rounded-10 shadow">
                        <div class="card-header">
                            <form accept="{{ url('pay-back/create') }}" autocomplete="off">
                                <div class="row d-flex flex-wrap">
                                    <div class="w-auto ml-4">
                                        <label class="mb-0 d-block small font-weight-bold">Receipt Number</label>
                                        <input type="text" class="form-control rounded-10" id="key" placeholder=""
                                            name="key" required="" autofocus="" value="{{ $key }}">
                                        <div class="valid-feedback">&nbsp;</div>
                                        <div class="invalid-feedback">&nbsp;</div>
                                    </div>
                                    <div class="w-auto ml-3">
                                        <label class="mb-0 d-block small font-weight-bold">&nbsp;</label>
                                        <button type="submit" class="btn btn-dark rounded-10 px-3">
                                            <i class="fa fa-check"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @if ($value !== null)
                    {{-- <form accept="{{ url('pay-back') }}" method="post">
                        @csrf --}}
                    <div class="col-12 mt-4">
                        <div class="row">
                            <div class="col-12">
                                <div class="card rounded-10 shadow">
                                    <div class="card-body overflow-auto">
                                        <form accept="{{ url('pay-back') }}" method="post" id="payback-form" autocomplete="off">
                                            @csrf
                                            <input type="hidden" name="payment_type" class="payment_type" value="">
                                            <table class="table table-custom" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>S.No</th>
                                                        <th>Item Name</th>
                                                        <th>Qty </th>
                                                        <th>Returned Qty </th>
                                                        <th>Return Qty</th>
                                                        <th>Unit Price</th>
                                                        <th>Discount</th>
                                                        <th>VAT Amount</th>
                                                        <th>Final Price</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if ($value !== null)
                                                        @foreach ($value->sale_order_items as $key => $values)
                                                            <?php $qty = getPaybackqty($values->qty, $values->id); ?>
                                                            <tr>
                                                                <input type="hidden"
                                                                    name="sale_order_item_id[{{ $values->id }}]"
                                                                    value="{{ $values->id }}">
                                                                <input type="hidden"
                                                                    name="sale_order_id[{{ $values->id }}]"
                                                                    value="{{ $values->sale_order_id }}">
                                                                <input type="hidden" name="item_id[{{ $values->id }}]"
                                                                    value="{{ $values->item_id }}">
                                                                <input type="hidden"
                                                                    name="price_size_id[{{ $values->id }}]"
                                                                    value="{{ $values->price_size_id }}">
                                                                <input type="hidden" name="item_name[{{ $values->id }}]"
                                                                    value="{{ $values->item_name }}">
                                                                <input type="hidden" name="price[{{ $values->id }}]"
                                                                    value="{{ $values->price }}">
                                                                <input type="hidden"
                                                                    name="item_unit_price[{{ $values->id }}]"
                                                                    value="{{ $values->item_unit_price }}">
                                                                <input type="hidden" name="discount[{{ $values->id }}]"
                                                                    value="{{ $values->discount_amount }}">
                                                                <input type="hidden"
                                                                    name="discount_percent[{{ $values->id }}]"
                                                                    value="{{ $values->discount_percent }}">
                                                                <input type="hidden" name="tax_amt[{{ $values->id }}]"
                                                                    value="{{ $values->tax_amt }}">
                                                                <input type="hidden" name="tax_type[{{ $values->id }}]"
                                                                    value="{{ $values->tax_type }}">
                                                                <input type="hidden"
                                                                    name="final_price[{{ $values->id }}]"
                                                                    value="{{ $values->total_price / $values->qty }}">
                                                                <input type="hidden"
                                                                    name="cost_price[{{ $values->id }}]"
                                                                    value="{{ $values->cost_price }}">
                                                                <td>{{ $key + 1 }}</td>
                                                                <td>{{ $values->item_name }}</td>
                                                                <td>{{ getPaybackqty($values->qty, $values->id) }}</td>
                                                                <td>{{ $values->qty - $qty }}</td>
                                                                @if ($qty > 0)
                                                                    <td>
                                                                        <input type="number"
                                                                            name="return_qty[{{ $values->id }}]"
                                                                            class="form-control rounded-10 return_qty"
                                                                            data-qty="{{ $qty }}"
                                                                            max="{{ $qty }}" style="width: 50%">
                                                                    </td>
                                                                @else
                                                                    <td>Already Returned</td>
                                                                @endif
                                                                <td>{{ showAmount($values->price) }}</td>
                                                                <td>{{ $values->discount_percent ? $values->discount_percent . ' %' : showAmount($values->discount_amount) }}
                                                                </td>
                                                                <td>{{ showAmount($values->tax_amt) }}</td>
                                                                <td>{{ showAmount($values->total_price / $values->qty) }}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </form>
                                        <div class="col-12">
                                            <div class="az-dashboard-nav border-0">
                                                <a href="javascript:void(0)"
                                                    class="nav-linkk btn btn-dark rounded-10 shadoww mr-2 mb-2 d-flex justify-content-center align-items-center"
                                                    data-toggle="modal" data-target="#payback-password">
                                                    <span><i class="fa fa-edit mr-1" id="submit-btn"></i> Submit</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- </form> --}}
                @endif
            </div>
        </div>
    </div>

    <div class="col-12">
        <h2 class="az-dashboard-title">Pay Back History </h2>

        <div class="card rounded-10 shadow">
            <div class="card-header">
                <form>
                    <div class="row d-flex flex-wrap">
                        <div class="w-auto ml-3">
                            <label class="mb-0 d-block small font-weight-bold">From Date</label>
                            <input type="date" name="from_date" class="form-control rounded-10" required
                                value="{{ request('from_date') ?: now()->format('Y-m-d') }}"
                                onchange="this.form.submit()">
                        </div>
                        <div class="w-auto ml-3">
                            <label class="mb-0 d-block small font-weight-bold">To Date</label>
                            <input type="date" name="to_date" class="form-control rounded-10" required
                                value="{{ request('to_date') ?: now()->format('Y-m-d') }}" onchange="this.form.submit()">
                        </div>
                        <div class="w-auto ml-3">
                            <label class="mb-0 d-block small font-weight-bold">Customers</label>
                            <select class="form-control rounded-10 select2" id="customer_id" name="customer_id"
                                onchange="this.form.submit()">
                                <option value="">Select Customer</option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}"
                                        {{ request('customer_id') == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->customer_name }}
                                    </option>
                                @endforeach
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
                                    <th>S.No</th>
                                    @if (!auth()->user()->branch_id)
                                        <th>Branch</th>
                                    @endif
                                    <th>Receipt ID</th>
                                    {{-- <th>Customer Name </th> --}}
                                    <th>Item Name</th>
                                    <th>Quantity</th>
                                    <th>Gross Total</th>
                                    <th>Discount</th>
                                    <th>Net Total</th>
                                    <th>Tax Amount</th>
                                    <th>Payment Type</th>
                                    <th>User</th>
                                </tr>
                            </thead>
                            <tbody>@php
                                $total_amount = $total_without_discount = $total_discount = $total_qty = 0;
                            @endphp
                                @if (count($payBacks) > 0)
                                    {{-- @dd($payBacks); --}}
                                    @foreach ($payBacks as $key => $value)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            @if (!auth()->user()->branch_id)
                                                <td>{{ $value->shop_id ? Str::ucfirst(getBranchById($value->shop_id)) : 'Unknown Branch' }}
                                                </td>
                                            @endif
                                            <td>{{ $value->receipt_id }}</td>
                                            {{-- <td>{{ $value->customer_name }}</td> --}}
                                            <td>{{ $value->item_name }}</td>
                                            <td>{{ $value->qty }}</td>
                                            <td>{{ showAmount($value->amount) }}</td>
                                            <td>{{ showAmount($value->discount) }}</td>
                                            <td>{{ showAmount($value->amount - $value->discount) }}</td>
                                            <td>{{ showAmount($value->tax_amt) }}</td>
                                            <td>{{ Str::ucfirst($value->payment_type) }}</td>
                                            <td>{{ $value->user_name }}</td>

                                            @php
                                                $total_amount += $value->amount;
                                                $total_discount += $value->discount;
                                                $total_without_discount += $value->amount - $value->discount;
                                            @endphp
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
                                    <td></td>
                                    <td>{{ showAmount($total_amount, 1) }}</td>
                                    <td>{{ showAmount($total_discount, 1) }}</td>
                                    <td>{{ showAmount($total_without_discount, 1) }}</td>
                                    <td></td>
                                    <td></td>
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


    <div class="modal fade" id="payback-password" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content rounded-10 popupContent-md">
                <div class="modal-header">
                    <h5 class="modal-title text-uppercase text-center w-100">Enter Payback Password</h5>
                </div>
                <div class="col-12 p-0">
                    <div class="modal-body" style="max-height: 70vh !important; overflow-x:auto">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mt-2 mb-2">
                                    <label class="mb-0">Payment Type</label>
                                    <select class="form-control rounded-10 onChange" id="payment_type"
                                        name="payment_type" required="">
                                        <option value="">Select Payment Type</option>
                                        @foreach ($PaymentLists as $PaymentList)
                                            @if ($PaymentList->payment_method_slug != 'credit')
                                                <option value="{{ $PaymentList->payment_method_slug }}"
                                                    data-id="{{ $PaymentList->id }}">
                                                    {{ $PaymentList->payment_method_name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <div class="valid-feedback">&nbsp;</div>
                                    <div class="invalid-feedback">&nbsp;</div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mt-2 mb-2">
                                    <label class="mb-0">Password</label>
                                    <input type="password" class="form-control rounded-10" id="password" placeholder=""
                                        name="password" autofocus="" value="" required>
                                    <div class="valid-feedback">&nbsp;</div>
                                    <div class="invalid-feedback">&nbsp;</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-dark px-4 text-uppercase rounded-10 modalClose"
                            data-dismiss="modal">Cancel</button>
                        <button type="submit"
                            class="btn btn-dark px-4 text-uppercase rounded-10 payback_btn">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (Session::has('print'))
        <iframe id="contentFrame"
            src="{{ url('pay-back-print') }}?token={{ Session::get('print') }}&receipt_id={{ Session::get('receipt_id') }}"
            style="display:none"></iframe>
    @endif

@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('#customer_id').select2({
            theme: "bootstrap-5",
        });
    });
</script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"
        integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @if (Session::has('print'))
        <script>
            const iframe = document.getElementById('contentFrame');
            const iframeWindow = iframe.contentWindow;

            // Open the print dialog for the iframe content
            iframeWindow.focus(); // Ensure the iframe is in focus
            iframeWindow.print();
        </script>
    @endif

    <script>
        $(".return_qty").on('keyup', function() {
            var qty = $(this).data('qty');
            var enter_qty = $(this).val();
            if (enter_qty > qty || enter_qty < 0) {
                $(this).val(qty);
            }
        });

        $(".payback_btn").on("click", function() {
            var password = $('#password').val();
            let total = 0;
            $('.return_qty').each(function() {
                let value = parseFloat($(this).val()); // Get the value and convert to float
                if (!isNaN(value)) {
                    total += value; // Add the value to the total if it's a number
                }
            });

            if (password != '') {
                if ("{{ app('appSettings')['payback_password']->value }}" == password) {
                    if (total == 0) {
                        notifyme2('Please Enter Qty to Return');
                        $("#payback-password").modal('hide');
                        return false;
                    }
                    if ($("#payment_type").val() == '') {
                        notifyme("#payment_type", "Please select Payment Type", "error", "bottom");
                        // notifyme2('Please select Payment Type');
                        return false;
                    }

                    $(".payment_type").val($("#payment_type").val())
                    $("#payback-form").submit();
                } else {
                    $("#password").val('');
                    notifyme2('Please Enter Correct Payback Password');
                    $("#password").focus();
                    return false;
                }
            } else {
                notifyme2('Please Enter Payback Password');
                $("#password").focus();
                return false;
            }
        });
    </script>

@endsection
