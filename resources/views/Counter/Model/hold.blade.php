
<div class="modal-header">
    <h5 class="modal-title text-uppercase text-center w-100">Hold List</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span class="material-symbols-outlined">
            close
        </span>
    </button>
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
                                                <th style="width: 15%">S.No</th>
                                                <th>Receipt No.</th>
                                                <th>Amount</th>
                                                <th>Ordered date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($hold_list) > 0)
                                                @foreach ($hold_list as $key => $item)
                                                    <tr>
                                                        <td style="width: 15%">{{ $key + 1 }}</td>
                                                        <td data-bs-toggle="tooltip" data-bs-placement="top" title="Receipt No.">
                                                            {{ Str::ucfirst($item->receipt_id) }}
                                                        </td>
                                                        <td data-bs-toggle="tooltip" data-bs-placement="top" title="Amount">
                                                            {{ showAmount($item->with_tax,1) }}
                                                        </td>
                                                        <td data-bs-toggle="tooltip" data-bs-placement="top" title="Ordered date">
                                                            {{ dateFormat($item->ordered_date) }}
                                                        </td>
                                                        <td>
                                                            {{-- <div class="btn-group rounded-0" role="group" aria-label="Basic example">
                                                                <a href="{{ url('home')."/".$item->uuid."/edit" }}" class="btn btn-dark rounded-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                                <a href="javascript:void(0)" class="btn btn-dark rounded-0 deleteSale" data-sale_id="{{ $item->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                                </a> --}}
                                                                {{-- <a href="{{ url('print?id=' . $item->id . '&re=home') }}" class="btn btn-dark rounded-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Print">
                                                                    <i class="fa fa-print" aria-hidden="true"></i>
                                                                </a> --}}
                                                            {{-- </div> --}}

                                                            <div class="btn-group rounded-10" role="group"
                                                                aria-label="Basic example" data-bs-toggle="tooltip"
                                                                data-bs-placement="top" title="edit">
                                                                <a href="{{ url('home')."/".$item->uuid."/edit" }}" class="btn btn-dark rounded-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                            </div>
                                                            <div class="btn-group rounded-10" role="group"
                                                                aria-label="Basic example" data-bs-toggle="tooltip"
                                                                data-bs-placement="top" title="Delete">
                                                                <a href="javascript:void(0)" class="btn btn-dark rounded-0 deleteSale" data-sale_id="{{ $item->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                                </a>
                                                            </div>
                                                            <?php $url = url('print') . '?id=' . $item->id . '&re=dashboard'; ?>
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
