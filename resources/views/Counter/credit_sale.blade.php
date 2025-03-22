@extends('Counter.Layout.theme')

@section('title', 'CREDIT SALE')

@section('style')

@endsection

@section('content')


    <?php

    // $receipt_id = (isset($_GET['receipt_id']) && $_GET['receipt_id'] != '') ? $_GET['receipt_id'] : '';
    $from_date = isset($_GET['from_date']) && $_GET['from_date'] != '' ? $_GET['from_date'] : date('Y-m-d');
    $to_date = isset($_GET['to_date']) && $_GET['to_date'] != '' ? $_GET['to_date'] : date('Y-m-d');
    $PaymentLists = PaymentList(auth()->user()->branch_id);
    ?>

    <div class="az-content az-content-dashboard  animate__animated animate__fadeIn">
        <div class="container-fluid">
            <div class="az-content-body">
                <div class="col-12">
                    <div class="az-dashboard-one-title">
                        <div>
                            <h2 class="az-dashboard-title mb-0">Credit sale</h2>
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
                                    <div class="w-auto ml-4">
                                        <label class="mb-0 d-block small font-weight-bold">Customer</label>
                                        <select class="form-control rounded-10 select2" id="customer_id" name="customer"
                                            onchange="this.form.submit()">
                                            <option value="">Select Customer</option>
                                            <?php $customers = getCustomerall(auth()->user()->branch_id); ?>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}"
                                                    @if ($customer->id == $customer_id) selected="selected" @endif>
                                                    {{ $customer->customer_number . ' - ' . Str::ucfirst($customer->customer_name) }}
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
                <div class="col-12 mt-4">
                    <div class="row p-2">
                        <div class="col-12">
                            <div class="card rounded-10 shadow">
                                <div class="card-body overflow-auto">
                                    <table id="example" class="table table-custom" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th style="width: 15%">S.No</th>
                                                <th>Customer</th>
                                                <th>Debit</th>
                                                <th>Credit</th>
                                                <th>Balance</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <?php $total_credit = $total_debit = $total_balance = 0; ?>
                                        <tbody>
                                            @if (count($credit_sale) > 0)
                                                @foreach ($credit_sale as $key => $value)
                                                    <?php

                                                    $balance = $value->credit - $value->debit;
                                                    $customer_number = getCustomerDetById($value->customer_id);//getCustomer($value->customer_id)->customer_number;
                                                    ?>
                                                    <tr>
                                                        <td style="width: 15%">{{ $key + 1 }}</td>
                                                        <td data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Customer Name">
                                                            {{ $customer_number }}</td>
                                                        <td data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Credit.">
                                                            {{ showAmount($value->credit) }}</td>
                                                        <td data-bs-toggle="tooltip" data-bs-placement="top" title="Debit">
                                                            {{ showAmount($value->debit) }}</td>
                                                        <td data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Balance">
                                                            {{ showAmount($balance) }}</td>
                                                        <td>
                                                            @if ($balance > 0)
                                                                <button
                                                                    class="dt-button buttons-excel buttons-html5 btn btn-dark px-3 rounded-10 PayModel"
                                                                    tabindex="0" aria-controls="example" type="button"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="Pay" id="PayModel"
                                                                    data-customer_id="{{ $value->customer_id }}"
                                                                    data-customer_number="{{ $customer_number }}"
                                                                    data-credit="{{ $value->credit }}"
                                                                    data-debit="{{ $value->debit }}"
                                                                    data-balance="{{ $balance }}"
                                                                    style="border-radius:10px;"><span>Pay</span></button>
                                                            @endif
                                                            <button id="createbtn"
                                                                class="dt-button buttons-excel buttons-html5 btn btn-dark px-3 rounded-10 dynamicPopup" data-pop="xl"
                                                                data-url="{{ url('credit-sale/create') }}?id={{ $value->customer_id }}"
                                                                data-toggle="modal"
                                                                data-target="#dynamicPopup-xl"
                                                                data-image="{{ url(config('constant.LOADING_GIF')) }}"
                                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Statement"
                                                                style="border-radius:10px;">
                                                                <i class="fa fa-list" aria-hidden="true" style="font-size:1.2rem">
                                                                </i></button>

                                                            {{-- <button
                                                                class="dt-button buttons-excel buttons-html5 btn btn-dark px-3 rounded-10"
                                                                tabindex="0" aria-controls="example" type="button"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="Statement" id="StatementModel"
                                                                style="border-radius:10px;">
                                                                <span>
                                                                    <i class="fa fa-list" aria-hidden="true"
                                                                        style="font-size:1.2rem">
                                                                    </i>
                                                                </span>
                                                            </button> --}}
                                                        </td>
                                                        <?php
                                                        $total_credit += $value->credit;
                                                        $total_debit += $value->debit;
                                                        $total_balance += $balance;
                                                        ?>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td style="width: 15%"></td>
                                                <td></td>
                                                <td class=" font-weight-bold">{{ showAmount($total_credit, 1) }}</td>
                                                <td class=" font-weight-bold">{{ showAmount($total_debit, 1) }}</td>
                                                <td class=" font-weight-bold">{{ showAmount($total_balance, 1) }}</td>
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

    <div class="modal fade" id="PayDetailsModel" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content rounded-10">
                <div class="modal-header">
                    <h5 class="modal-title text-uppercase text-center w-100">Enter Discount</h5>
                </div>
                <form id="CreditForm" class="was-validated" autocomplete="off">
                    <div class="col-12 p-0">
                        <div class="modal-body" style="max-height: 70vh !important; overflow-x:auto">
                            <input type="hidden" name="cus_id" id="cus_id" value="">
                            <div class="row p-2">
                                <div class="col-12">
                                    <div class="form-group mt-0 mb-0">
                                        <label class="mb-0">Customer</label>
                                        <input type="text" class="form-control rounded-10" id="customer_number"
                                            placeholder="" name="customer_number" required="" autofocus=""
                                            value="" readonly>
                                        <div class="valid-feedback">&nbsp;</div>
                                        <div class="invalid-feedback">&nbsp;</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row p-2">
                                <div class="col-12">
                                    <div class="form-group mt-0 mb-0">
                                        <label class="mb-0">Balance</label>
                                        <input type="text" class="form-control rounded-10" id="balance"
                                            placeholder="" name="balance" required="" autofocus="" value=""
                                            readonly>
                                        <div class="valid-feedback">&nbsp;</div>
                                        <div class="invalid-feedback">&nbsp;</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row p-2">
                                <div class="col-12">
                                    <div class="form-group mt-0 mb-0">
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
                            </div>
                            <div class="row p-2">
                                <div class="col-12">
                                    <div class="form-group mt-0 mb-0">
                                        <label class="mb-0">Amount</label>
                                        <input type="text" class="form-control rounded-10" id="amount"
                                            placeholder="" name="amount" required="" autofocus="" value="">
                                        <div class="valid-feedback">&nbsp;</div>
                                        <div class="invalid-feedback">&nbsp;</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-dark px-4 text-uppercase rounded-10 modalClose"
                                data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-dark px-4 text-uppercase rounded-10 submitForm"
                                data-method="adminedit" data-form="CreditForm" data-target="{{ url('credit-sale') }}"
                                data-returnaction="reload" data-image="{{ url(config('constant.LOADING_GIF')) }}"
                                data-processing="Please wait, saving...">Save</button>
                            {{-- <button type="submit" class="btn btn-dark px-4 text-uppercase rounded-10 CreditPayBtn">Save</button> --}}
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('script')

    <script>
        $(document).ready(function() {
            $('#customer_id').select2({
                theme: "bootstrap-5",
            });
        });
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });

        $(".PayModel").on('click', function() {
            $("#cus_id").val($(this).data('customer_id'));
            $("#customer_number").val($(this).data('customer_number'));
            $("#credit").val($(this).data('credit'));
            $("#debit").val($(this).data('debit'));
            $("#balance").val($(this).data('balance'));
            // $("#customer_number").val($(this).data('customer_number'));
            $("#PayDetailsModel").modal('show');
        });

        $("#amount").on("keyup", function() {
            var amount = $(this).val();
            var balance = $("#balance").val();
            if (parseFloat(amount) > parseFloat(balance)) {
                $(this).val(balance);
            }
        });

        // $("#CreditPayBtn").on("click",function(){
        //     var customer_id = $("cus_id").val();
        //     var balance = $("#balance").val();
        //     var amount = $("#amount").val();

        //     if(parseFloat(amount) > parseFloat(balance)){
        //         $.ajax({
        //             type: "POST",
        //             url: "{{ url('credit-sale') }}",
        //             headers: {
        //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //             },
        //             data: 'customer_number=' + $(this).val(),
        //             dataType: "JSON",
        //             // beforeSend: function(){
        //             //     $("#customer_number").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
        //             // },
        //             success: function(data) {
        //                 let results = JSON.parse(JSON.stringify(data));
        //                 dropdown.innerHTML = '';
        //                 results.data.forEach(item => {
        //                     let listItem = document.createElement('li');
        //                     listItem.textContent = item.customer_number;
        //                     listItem.addEventListener('click', function() {
        //                         // document.getElementById('customer_number').value = item.customer_number;
        //                         $("#customer_id_form").val(item.id);
        //                         $("#customer_uuid_form").val(item.uuid);
        //                         $("#customer_number").val(item
        //                             .customer_number);
        //                         $("#customer_name").val(item.customer_name);
        //                         $("#customer_email").val(item
        //                             .customer_email);
        //                         $("#customer_address").val(item
        //                             .customer_address);
        //                         $("#customer_gender").val(item
        //                             .customer_gender);
        //                         dropdown.style.display = 'none';
        //                     });
        //                     dropdown.appendChild(listItem);
        //                     dropdown.style.display = 'block';
        //                 });
        //             }
        //         });
        //     }else{
        //         notifyme2("Payment Amount Should Be Lesser than Balance Amount");
        //     }

        // });
    </script>

@endsection
