@extends('Admin.theme')
<?php

$from_date = isset($_GET['from_date']) && $_GET['from_date'] != '' ? $_GET['from_date'] : date('Y-m-d');
$to_date = isset($_GET['to_date']) && $_GET['to_date'] != '' ? $_GET['to_date'] : date('Y-m-d');
$session_branch = getSessionBranch() ? ' - ' . getBranchById(getSessionBranch()) : '';
$branch_name = auth()->user()->branch_id ? ' - ' . auth()->user()->branch->branch_name : $session_branch;
$title = 'WASTAGE USAGE REPORT' . $branch_name . ' - ' . $from_date . ' - ' . $to_date;

?>
@section('title', $title)

@section('style')

@endsection

@section('content')


    <?php

    $user_id = isset($_GET['user_id']) && $_GET['user_id'] != '' ? $_GET['user_id'] : '';

    ?>
    {{-- @dd($wastageUsageData); --}}
    <div class="az-content az-content-dashboard  animate__animated animate__fadeIn">
        <div class="container-fluid">
            <div class="az-content-body">
                <div class="col-12">
                    <div class="az-dashboard-one-title">
                        <div>
                            <h2 class="az-dashboard-title">Wastage Usage Report</h2>
                            <p class="az-dashboard-text"></p>
                        </div>
                        <div class="az-content-header-right">
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card rounded-10 shadow">
                        <div class="card-header">
                            <form method="GET" >
                                <div class="row d-flex flex-wrap">
                                    <div class="w-auto ml-3">
                                        <label class="mb-0 d-block small font-weight-bold">From Date</label>
                                        <input type="date" value="{{ request('from_date', $from_date) }}" name="from_date"
                                            class="form-control rounded-10" required onchange="this.form.submit()">
                                    </div>
                                    <div class="w-auto ml-3">
                                        <label class="mb-0 d-block small font-weight-bold">To Date</label>
                                        <input type="date" value="{{ request('to_date', $to_date) }}" name="to_date"
                                            class="form-control rounded-10" required onchange="this.form.submit()">
                                    </div>
                                    <div class="w-auto ml-3">
                                        <label class="mb-0 d-block small font-weight-bold">Item</label>
                                        <select class="form-control rounded-10 select2" id="item_id" name="item_id"
                                            onchange="this.form.submit()">
                                            <option value="">Select Item</option>
                                            @foreach ($items as $value)
                                                <option value="{{ $value->item_id }}"
                                                    @if ($value->item_id == $item_id) selected="selected" @endif>
                                                      {{ $value->item_name }}{{ $value->size_name === 'Unit price' ? '' : ' - ' . $value->size_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="w-auto ml-3">
                                        <label class="mb-0 d-block small font-weight-bold">User</label>
                                        <select class="form-control rounded-10 select2" id="user_id" name="user_id"
                                            onchange="this.form.submit()">
                                            <option value="">Select User</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}"
                                                    {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                                    {{ $user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="w-auto ml-3 mt-1">
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
                    <div class="row">
                        <div class="col-12">
                            <div class="card rounded-10 shadow">
                                <div class="card-body overflow-auto">
                                    {{-- <div class="dt-buttons">
                                        <a href="{{ url('admin/user-wise-excel') }}?from_date={{ $from_date }}&to_date={{ $to_date }}&user_id={{ $user_id }}"
                                            class="dt-button buttons-excel buttons-html5 btn btn-dark px-3 rounded-10"
                                            tabindex="0" aria-controls="example" type="button"><span><i
                                                    class="fa fa-file-excel-o" style="font-size:1.2rem"></i></span>
                                        </a>
                                        <a href="{{ url('admin/user-wise-print') }}?from_date={{ $from_date }}&to_date={{ $to_date }}&user_id={{ $user_id }}" class="dt-button buttons-print btn btn-dark px-3 rounded-10" tabindex="0"
                                            aria-controls="example" type="button"><span><i class="fa fa-file-pdf-o"
                                                    style="font-size:1.2rem"></i></span>
                                        </a>
                                    </div> --}}
                                    <table id="example" class="table table-hover table-custom border-bottom-0"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                @if (!auth()->user()->branch_id)
                                                    <th>Branch</th>
                                                @endif
                                                <th>Item Name</th>
                                                <th>User</th>
                                                <th>Wastage</th>
                                                <th>Usage</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($wastageUsageData as $key => $value)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    @if (!auth()->user()->branch_id)
                                                        <td>{{ getBranchById($value->branch_id) }}</td>
                                                    @endif
                                                    <td>{{ $value->item_name }}</td>
                                                    <td>{{ $value->user_name }}</td>
                                                    <td>{{ $value->wastage_qty }}</td>
                                                    <td>{{ $value->usage_qty }}</td>
                                                </tr>
                                            @endforeach
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
        $('#item_id').select2({
            theme: "bootstrap-5",
        });
    });
</script>

@endsection
