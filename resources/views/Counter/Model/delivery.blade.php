<?php
    $PaymentLists = PaymentList(auth()->user()->branch_id);?>
<div class="modal-header">
    <h5 class="modal-title text-uppercase text-center w-100">Delivery List</h5>
    <button type="button" class="btn btn-outline-dark px-4 text-uppercase rounded-10"
        data-dismiss="modal">&times;</button>
</div>
<div class="modal-body pt-0" style="max-height: 70vh !important; overflow-x:auto">
    <div class="animate__animated animate__fadeIn">
        <div class="container-fluid">
            <div class="az-content-body">
                <div class="col-12 mt-4">
                    <div class="row">
                        <div class="col-12">
                            {{-- <div class="card rounded-10 shadow"> --}}
                                {{-- <div class="card-body overflow-auto"> --}}
                                    <table id="example" class="table table-custom" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%">S.No</th>
                                                <th>Receipt No.</th>
                                                <th>Customer Number</th>
                                                <th>Discount</th>
                                                <th>Amount</th>
                                                <th>Ordered date</th>
                                                <th>Payment Type</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($delivery_list) > 0)
                                                @foreach ($delivery_list as $key => $delivery)
                                                    <tr>
                                                        <td style="width: 5%">{{ $key + 1 }}</td>
                                                        <td data-bs-toggle="tooltip" data-bs-placement="top" title="Receipt No.">
                                                            {{ Str::ucfirst($delivery->receipt_id) }}
                                                        </td>
                                                        <td data-bs-toggle="tooltip" data-bs-placement="top" title="Customer Number">
                                                            {{ Str::ucfirst($delivery->customer_number) }}
                                                        </td>
                                                        <td data-bs-toggle="tooltip" data-bs-placement="top" title="Discount">
                                                            {{ showAmount($delivery->discount) }}
                                                        </td>
                                                        <td data-bs-toggle="tooltip" data-bs-placement="top" title="Amount">
                                                            {{ showAmount($delivery->with_tax) }}
                                                        </td>
                                                        <td data-bs-toggle="tooltip" data-bs-placement="top" title="Ordered date">
                                                            {{ dateFormat($delivery->ordered_date) }}
                                                        </td>
                                                        <td>
                                                            <select name="delivery_sale" id="" class="form-control rounded-10 changedeliverystatus" data-sale_id="{{ $delivery->id }}"
                                                                data-key="{{ $key }}" data-total="{{ $delivery->with_tax }}">
                                                                {{-- onchange="changedeliverystatus('{{ $delivery->id }}',{{ $key }})"> --}}
                                                                <option value="pending"
                                                                @if ($delivery->status == 'pending')
                                                                    selected
                                                                @endif>
                                                                Pending</option>
                                                                <option value="out_for_delivery"
                                                                @if ($delivery->status == 'out_for_delivery')
                                                                    selected
                                                                @endif>
                                                                Out for delivery</option>
                                                                <option value="delivered"
                                                                @if ($delivery->status == 'delivered')
                                                                    selected
                                                                @endif>
                                                                Delivered</option>
                                                                <option value="reject"
                                                                @if ($delivery->status == 'reject')
                                                                    selected
                                                                @endif>
                                                                Cancelled</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select name="payment_type" id="" class="form-control rounded-10 payment_type{{ $key }}" >
                                                                {{-- <option value="">Select Payment Type</option> --}}
                                                                @foreach ($PaymentLists as $PaymentList)
                                                                    @if ($PaymentList->payment_method_slug != 'credit')
                                                                        <option value="{{ $PaymentList->payment_method_slug }}"
                                                                            data-id="{{ $PaymentList->id }}">
                                                                            {{ $PaymentList->payment_method_name }}
                                                                        </option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            @if ($delivery->status == 'pending')

                                                                <div class="btn-group rounded-10" role="group"
                                                                    aria-label="Basic example" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top" title="edit">
                                                                    <a href="{{ url('home')."/".$delivery->uuid."/edit" }}" class="btn btn-dark rounded-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                                        <i class="fa fa-edit"></i>
                                                                    </a>
                                                                </div>
                                                                <div class="btn-group rounded-10" role="group"
                                                                    aria-label="Basic example" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top" title="Delete">
                                                                    <a href="javascript:void(0)" class="btn btn-dark rounded-0 deleteSale" data-sale_id="{{ $delivery->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                                    </a>
                                                                </div>
                                                            @endif
                                                            <?php $url = url('print') . '?id=' . $delivery->id . '&re=dashboard'; ?>
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
                                {{-- </div> --}}
                            {{-- </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="if"></div>
{{-- <div class="modal-footer">
    <button type="button" class="btn btn-outline-dark px-4 text-uppercase rounded-10"
        data-dismiss="modal">Close</button>
</div> --}}
</div>
<script>
    $('#example').dataTable({
        "language": {
            "emptyTable": "No Data found"
        }
    });
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });

    // function changedeliverystatus(sale_id,key)
    // {
        $(document).on("change", ".changedeliverystatus", function (e) {
            var sale_id = $(this).data("sale_id");
            var key = $(this).data("key");
            var status = $(this).val();
            var total = $(this).data("total");
            var payment_type = $(".payment_type"+key).val();
        if (sale_id && confirm("Are you sure, You want to change status?")) {
            $.ajax({
                url: "{{ url('change-delivery-status') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    sale_id: sale_id,
                    status: status,
                    type: 'status',
                    total: total,
                    payment_type: payment_type,
                },
                type: "post",
                success: function (response) {
                    if (response == "success") {
                        notifyme2("Status Changed succesfully");
                        location.reload();
                    } else {
                        notifyme2("Something Went Wrong! please try again.");
                    }
                },
            });
        } else {
            return false;
        }
    // }
    });

    $(document).on("click", ".deleteSale", function (e) {
        var sale_id = $(this).data("sale_id");
        var returnaction = 'reload';
        if (sale_id && confirm("Are you sure, You want to delete?")) {
            $.ajax({
                url: "{{ url('change-delivery-status') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    sale_id: sale_id,
                    type: 'delete',
                },
                type: "post",
                success: function (response) {
                    if (response == "success") {
                        notifyme2("Deleted succesfully");
                        if (returnaction == "reload") {
                            setTimeout(function () {
                                location.reload();
                            }, 1000);
                        }
                    } else {
                        notifyme2("Something Went Wrong! please try again.");
                    }
                },
            });
        } else {
            return false;
        }
    // }
    });
</script>
