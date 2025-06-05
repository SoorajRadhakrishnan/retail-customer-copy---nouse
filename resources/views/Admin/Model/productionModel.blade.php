<?php $branch_id = getbranchid();



$from_date = isset($_GET['from_date']) && $_GET['from_date'] != '' ? $_GET['from_date'] : date('Y-m-d');
$to_date = isset($_GET['to_date']) && $_GET['to_date'] != '' ? $_GET['to_date'] : date('Y-m-d');
$session_branch = getSessionBranch() ? ' - ' . getBranchById(getSessionBranch()) : '';
$branch_name = auth()->user()->branch_id ? ' - ' . auth()->user()->branch->branch_name : $session_branch;

?>
<div class="modal-header">
    <h5 class="modal-title text-uppercase text-center w-100">PRODUCTION LOG</h5>
</div>
<form id="PurchaseForm" class="was-validated" autocomplete="off">
    {{-- <input type="hidden" name="id" value="{{ $latestRecord->id }}">
    <input type="hidden" name="branch_id" value="{{ $branch_id }}"> --}}
    @csrf
    <div class="col-12 p-0">
        <div class="modal-body" style="max-height: 70vh !important; overflow-x:auto">
            <div class="row">
                <table class="table table-hover table-custom border-bottom-0 px-1" style="width: 100%">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            @if (!auth()->user()->branch_id)
                                <th>Branch</th>
                            @endif
                            <th>Item</th>
                            <th style="width: 200px">Quantity</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $key => $record)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                @if (!auth()->user()->branch_id)
                                    <td>{{ getBranchById($record->shop_id) }}</td>
                                @endif
                                <td>{{ Str::ucfirst(getItemNameSize($record->price_id)) }}</td>
                                <td >
                                    @if ($record->id === $latestRecord->id)
                                        <!-- Editable quantity for the latest record -->
                                        <input type="number" class="form-control rounded-10 w-50 qty-input"
                                               data-id="{{ $record->id }}"
                                               data-url="{{ url('admin/update-qty') }}"
                                               value="{{ $record->qty }}">
                                    @else
                                        <!-- Display quantity for older records -->
                                       <!-- Editable quantity for the latest record -->
                                       <input type="number" class="form-control rounded-10 w-50 qty-input"
                                       data-id="{{ $record->id }}" value="{{ $record->qty }}" disabled >
                                    @endif
                                </td>
                                <td>{{ date('d-m-Y', strtotime($record->created_at)) }}</td>
                                <td>
                                    @if ($record->id === $latestRecord->id)
                                        <!-- Action buttons for the latest record -->
                                        <button type="button" class="btn btn-dark rounded-10 shadoww mr-2 mb-2 d-flex justify-content-center align-items-center update-quantity" data-url="{{url('update-qty')}}">Update</button>
                                    @else
                                        <!-- Disable actions for older records -->
                                        <button type="button" class="btn  rounded-10 shadoww mr-2 mb-2 d-flex justify-content-center align-items-center btn-secondary" disabled>update</button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center"  colspan="5">No data available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-outline-dark px-4 text-uppercase rounded-10 modalClose"
                data-dismiss="modal">Cancel</button>
            {{-- <button type="submit" class="btn btn-dark px-4 text-uppercase rounded-10 submitForm"
                data-method="adminedit" data-form="PurchaseForm" data-target="{{ url('admin/update-production-qty') }}"
                data-returnaction="reload" data-image="{{ url(config('constant.LOADING_GIF')) }}"
                data-processing="Please wait, saving...">Save</button> --}}
        </div>
    </div>
</form>

<script>
    $(document).ready(function() {
        $('#items').select2({
            theme: "bootstrap-5",
            dropdownParent: $("#PurchaseForm"), //add this code
        });
    });


    $(document).on('click', '.update-quantity', function () {
    const row = $(this).closest('tr');
    const qty = row.find('.qty-input').val();
    const id = row.find('.qty-input').data('id');
    const url = row.find('.qty-input').data('url');

    if (qty && qty > 0) {
        $.ajax({
            url: url,
            type: 'get',
            data: {
                id: id,
                qty: qty,
                _token: $('input[name="_token"]').val(),
            },
            success: function (response) {
                if (response.status === 1) {
                    notifyme2('Quantity updated successfully!');
                    location.reload(); // Optional: Reload page to refresh data
                } else {
                    notifyme2('Failed to update quantity: ' + response.message);
                }
            },
            error: function () {
                notifyme2('An error occurred while updating the quantity.');
            },
        });
    } else {
        notifyme2('Please enter a valid quantity.');
    }
});

</script>
